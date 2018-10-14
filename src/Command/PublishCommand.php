<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Command;

use Psr\Log\LoggerInterface;
use Reinfi\BambooSpec\Client\ClientFactory;
use Reinfi\BambooSpec\Config\Config;
use Reinfi\BambooSpec\Config\ConfigParser;
use Reinfi\BambooSpec\Credentials\CredentialsParser;
use Reinfi\BambooSpec\Entry\EntryPointInterface;
use Reinfi\BambooSpec\Exception\FailedException;
use Reinfi\BambooSpec\Exception\ValidationException;
use Reinfi\BambooSpec\Server\BambooServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Reinfi\BambooSpec\Command
 */
class PublishCommand extends Command
{
    /**
     * @var ConfigParser
     */
    private $configParser;

    /**
     * @var CredentialsParser
     */
    private $credentialsParser;

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    public function __construct()
    {
        parent::__construct('publish');

        $this->configParser = new ConfigParser();
        $this->credentialsParser = new CredentialsParser();
        $this->clientFactory = new ClientFactory();
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setDescription('Update bamboo definitions')
            ->addOption(
                'config',
                'c',
                InputOption::VALUE_REQUIRED,
                'config file to process'
            )->addOption(
                'username',
                'u',
                InputOption::VALUE_OPTIONAL,
                'username if not provided by config'
            )->addOption(
                'password',
                'p',
                InputOption::VALUE_OPTIONAL,
                'password if not provided by config'
            );

    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $config = $this->configParser->parse($input->getOption('config'));
        $credentials = $this->credentialsParser->parse($config, $input);
        $client = $this->clientFactory->getClient($config, $credentials);
        $output->setVerbosity(OutputInterface::VERBOSITY_DEBUG);
        $logger = new ConsoleLogger($output);
        $server = new BambooServer($client, $logger);

        $entry = $this->getEntryClass($config);

        try {
            $entry->configure($server);
        } catch (ValidationException $exception) {
            $this->printValidationErrors($logger, $exception);

            return 1;
        } catch (FailedException $exception) {
            return 1;
        }

        return 0;
    }

    protected function getEntryClass(Config $config): EntryPointInterface
    {
        $entryClass = $config->getEntry();

        return new $entryClass;
    }

    protected function printValidationErrors(
        LoggerInterface $logger,
        ValidationException $exception
    ): void {
        $logger->error('There are validation errors in your configuration:');

        foreach ($exception->getErrors() as $error) {
            $logger->error($error);
        }
    }
}
