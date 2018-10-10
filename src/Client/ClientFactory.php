<?php

namespace Reinfi\BambooSpec\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Reinfi\BambooSpec\Config\Config;
use Reinfi\BambooSpec\Credentials\CredentialsInterface;

/**
 * @package Reinfi\BambooSpec\Client
 */
class ClientFactory
{
    public function getClient(
        Config $config,
        ?CredentialsInterface $credentials
    ): ClientInterface {
        $clientOptions = [
            'base_uri'              => $config->getServerUrl(),
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/x-yaml',
                'version'      => '6.6.3',
            ],
        ];

        if ($credentials instanceof CredentialsInterface) {
            $clientOptions[RequestOptions::AUTH] = [
                $credentials->getUsername(),
                $credentials->getPassword(),
            ];
        }

        return new Client(
            $clientOptions
        );
    }
}
