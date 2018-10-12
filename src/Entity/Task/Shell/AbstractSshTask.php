<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Shell;

use Reinfi\BambooSpec\Entity\Task\AbstractTask;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Shell
 */
abstract class AbstractSshTask extends AbstractTask
{
    protected const DEFAULT_PORT = 22;

    protected const AUTHENTICATION_PASSWORD = 'PASSWORD';
    protected const AUTHENTICATION_KEY_WITHOUT_PASSPHRASE = 'KEY_WITHOUT_PASSPHRASE';
    protected const AUTHENTICATION_KEY_WITH_PASSPHRASE = 'KEY_WITH_PASSPHRASE';

    /** @var string */
    protected $host;

    /** @var string */
    protected $username;

    /** @var string */
    protected $authenticationType;

    /** @var string */
    protected $password;

    /** @var string */
    protected $key;

    /** @var string */
    protected $passphrase;

    /** @var string */
    protected $hostFingerprint;

    /** @var int */
    protected $port = AbstractSshTask::DEFAULT_PORT;

    /**
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
    }

    /**
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /*
    protected SharedCredentialsIdentifierProperties sharedCredentials;
    */

    /**
     * @param string $password
     *
     * @return self
     */
    public function authenticateWithPassword(string $password): self
    {
        $this->password = $password;
        $this->authenticationType = self::AUTHENTICATION_PASSWORD;

        return $this;
    }

    /**
     * Authenticate with key with passphrase.
     *
     * @param $key - SSH private key
     * @param $passphrase - SSH passphrase
     *
     * @return self
     */
    public function authenticateWithKeyWithPassphrase(
        string $key,
        string $passphrase
    ): self {
        $this->authenticationType = self::AUTHENTICATION_KEY_WITH_PASSPHRASE;
        $this->key = $key;
        $this->passphrase = $passphrase;

        return $this;
    }

    /**
     * Authenticate with key (without passphrase).
     *
     * @param $key - SSH private key
     *
     * @return self
     */
    public function authenticateWithKey(string $key): self
    {
        $this->authenticationType = self::AUTHENTICATION_KEY_WITHOUT_PASSPHRASE;
        $this->key = $key;

        return $this;
    }

    /**
     * @param string $hostFingerprint
     *
     * @return self
     */
    public function setHostFingerprint(string $hostFingerprint): self
    {
        $this->hostFingerprint = $hostFingerprint;

        return $this;
    }

    /**
     * @param int $port
     *
     * @return AbstractSshTask
     */
    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }
}
