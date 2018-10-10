<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Server;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Reinfi\BambooSpec\Builder\SpecBuilder;
use Reinfi\BambooSpec\Entity\Plan;
use Reinfi\BambooSpec\Entity\SpecEntityInterface;

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

    public function __construct(
        ClientInterface $client,
        LoggerInterface $logger = null,
        SpecBuilder $specBuilder = null
    ) {
        $this->client = $client;
        $this->logger = $logger ?: new NullLogger();
        $this->specBuilder = $specBuilder ?: new SpecBuilder();
    }

    public function publish(SpecEntityInterface $entity): void
    {
        $specData = $this->specBuilder->build($entity);

        $this->logger->info(
            sprintf(
                'Updating %s',
                $entity->getHumanReadableId()
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
                    $entity->getHumanReadableId(),
                    json_decode($response->getBody()->getContents())
                )
            );
        } catch (RequestException $exception) {
            $this->logger->error(
                $exception->getMessage()
            );

            throw $exception;
        }
    }

    private function getApiUrl(SpecEntityInterface $entity): string
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
