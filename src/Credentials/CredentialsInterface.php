<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Credentials;

/**
 * @package Reinfi\BambooSpec\Credentials
 */
interface CredentialsInterface
{
    public function getUsername(): string;

    public function getPassword(): string;
}
