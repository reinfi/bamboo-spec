<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Credentials;

use Reinfi\BambooSpec\Config\Config;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @package Reinfi\BambooSpec\Credentials
 */
class CredentialsParser
{
    public function parse(
        Config $config,
        InputInterface $input
    ): ?CredentialsInterface {

        if ($config->hasCredentials()) {
            $credentials = $config->getCredentials();

            return new UsernamePasswordCredentials(
                $credentials['username'] ?? '',
                $credentials['password'] ?? ''
            );
        }

        if ($input->hasOption('username') && $input->hasOption('password')) {
            return new UsernamePasswordCredentials(
                $input->getOption('username'),
                $input->getOption('password')
            );
        }

        return null;
    }
}
