<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Server;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Reinfi\BambooSpec\Builder\SpecBuilder;
use Reinfi\BambooSpec\Entity\Plan;
use Reinfi\BambooSpec\Entity\PublishableEntityInterface;
use Reinfi\BambooSpec\Exception\FailedException;
use Reinfi\BambooSpec\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * @package Reinfi\BambooSpec\Server
 */
class BambooServer implements ServerInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SpecBuilder
     */
    private $specBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        ClientInterface $client,
        LoggerInterface $logger = null,
        SpecBuilder $specBuilder = null,
        ValidatorInterface $validator = null
    ) {
        $this->client = $client;
        $this->logger = $logger ?: new NullLogger();
        $this->specBuilder = $specBuilder ?: new SpecBuilder();
        $this->validator = $validator ?: (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
    }

    public function publish(PublishableEntityInterface $entity): void
    {
        $this->validate($entity);

        $specData = $this->specBuilder->build($entity);

        $this->logger->info(
            sprintf(
                'Updating %s',
                $entity->__toString()
            )
        );

        $request = new Request(
            'POST',
            $this->getApiUrl($entity),
            [],
            $specData
        );

        try {
            $response = $this->client->send($request);

            $this->logger->info(
                sprintf(
                    'Successful update of %s, visit %s',
                    (string) $entity,
                    json_decode($response->getBody()->getContents())
                )
            );
        } catch (ClientException $exception) {
            $jsonResponse = @json_decode($exception->getResponse()->getBody()->getContents(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw $exception;
            }

            $errors = $jsonResponse['errors'] ?? null;

            if ($errors === null || !\is_array($errors)) {
                throw $exception;
            }

            $this->logger->error('Following errors occured during update:');
            foreach ($errors as $error) {
                $this->logger->error($error);
            }

            throw new FailedException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (RequestException $exception) {
            $this->logger->error(
                $exception->getMessage()
            );

            throw $exception;
        }
    }

    private function validate(PublishableEntityInterface $entity): void
    {
        $validationErrors = $this->validator->validate($entity);

        if (count($validationErrors) === 0) {
            return;
        }

        throw new ValidationException($validationErrors);
    }

    private function getApiUrl(PublishableEntityInterface $entity): string
    {
        if ($entity instanceof Plan) {
            return "rest/api/latest/import/plan";
        } /*else if (entity instanceof Deployment) {
            return "rest/api/latest/import/deployment";
        } else if (entity instanceof VcsRepository) {
            return "rest/api/latest/import/repository";
        } else if (entity instanceof SharedCredentials) {
            return "rest/api/latest/import/sharedCredentials";
        } else if (entity instanceof PlanPermissions) {
            return "rest/api/latest/import/plan/permission";
        } else if (entity instanceof DeploymentPermissions) {
            return "rest/api/latest/import/deployment/permission";
        } else if (entity instanceof EnvironmentPermissions) {
            return "rest/api/latest/import/deployment/environment/permission";
        } */ else {
            throw new \InvalidArgumentException(
                "Unknown entity " . get_class($entity)
            );
        }
    }
}
