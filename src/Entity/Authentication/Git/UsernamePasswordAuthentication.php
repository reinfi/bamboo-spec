<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Authentication\Git;

use Reinfi\BambooSpec\Entity\Authentication\AuthenticationInterface;

/**
 * @package Reinfi\BambooSpec\Entity\Authentication\Git
 */
class UsernamePasswordAuthentication implements AuthenticationInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.repository.git.UserPasswordAuthenticationProperties';
    }
}
