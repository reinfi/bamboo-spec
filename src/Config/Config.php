<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Config;

/**
 * @package Reinfi\BambooSpec\Config
 */
class Config
{
    /**
     * @var string
     */
    private $entry;

    /**
     * @var array
     */
    private $server;

    /**
     * @var array|null
     */
    private $credentials;

    /**
     * @param string $entry
     * @param array  $server
     * @param array|null  $credentials
     */
    public function __construct(
        string $entry,
        array $server,
        ?array $credentials
    ) {
        $this->entry = $entry;
        $this->server = $server;
        $this->credentials = $credentials;
    }

    public function getEntry(): string
    {
        return $this->entry;
    }

    public function getServerUrl(): ?string
    {
        return $this->server['url'] ?? null;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }

    public function hasCredentials(): bool
    {
        return $this->credentials !== null;
    }
}
