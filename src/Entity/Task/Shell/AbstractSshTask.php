<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Shell;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Identifier\Credentials\SharedCredentialsIdentifier;
use Reinfi\BambooSpec\Entity\Task\AbstractTask;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Shell
 */
abstract class AbstractSshTask extends AbstractTask
{
    protected const DEFAULT_PORT = 22;

    protected const AUTHENTICATION_PASSWORD = 'PASSWORD';
    protected const AUTHENTICATION_KEY_WITHOUT_PASSPHRASE = 'KEY_WITHOUT_PASSPHRASE';
    protected const AUTHENTICATION_KEY_WITH_PASSPHRASE = 'KEY_WITH_PASSPHRASE';

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $username;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Choice({"PASSWORD", "KEY_WITHOUT_PASSPHRASE", "KEY_WITH_PASSPHRASE"})
     *
     * @var string
     */
    protected $authenticationType;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $passphrase;

    /**
     * @Assert\Valid()
     *
     * @Serializer\SerializedName("sharedCredentialsIdentifierProperties")
     *
     * @var SharedCredentialsIdentifier
     */
    protected $sharedCredentials;

    /**
     * @var string
     */
    protected $hostFingerprint;

    /**
     * @Assert\GreaterThanOrEqual(0)
     *
     * @var int
     */
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
     * @param string $password
     *
     * @return self
     */
    public function authenticateWithPassword(
        string $username,
        string $password
    ): self {
        $this->username = $username;
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
    public function authenticateWithKeyAndPassphrase(
        string $username,
        string $key,
        string $passphrase
    ): self {
        $this->authenticationType = self::AUTHENTICATION_KEY_WITH_PASSPHRASE;
        $this->username = $username;
        $this->key = $key;
        $this->passphrase = $passphrase;

        return $this;
    }

    /**
     * Authenticate with key (without passphrase).
     *
     * @param string $username
     * @param string $key - SSH private key
     *
     * @return self
     */
    public function authenticateWithKey(
        string $username,
        string $key
    ): self {
        $this->authenticationType = self::AUTHENTICATION_KEY_WITHOUT_PASSPHRASE;
        $this->username = $username;
        $this->key = $key;

        return $this;
    }

    /**
     * @param SharedCredentialsIdentifier $sharedCredentialsIdentifier
     *
     * @return AbstractSshTask
     */
    public function authenticateWithSshSharedCredentials(
        SharedCredentialsIdentifier $sharedCredentialsIdentifier
    ): self {
        $this->authenticationType = self::AUTHENTICATION_KEY_WITH_PASSPHRASE;
        $this->sharedCredentials = $sharedCredentialsIdentifier;

        return $this;
    }

    /**
     * @param SharedCredentialsIdentifier $sharedCredentialsIdentifier
     *
     * @return AbstractSshTask
     */
    public function authenticateWithUsernamePasswordSharedCredentials(
        SharedCredentialsIdentifier $sharedCredentialsIdentifier
    ): self {
        $this->authenticationType = self::AUTHENTICATION_PASSWORD;
        $this->sharedCredentials = $sharedCredentialsIdentifier;

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

    /**
     * @Assert\Callback()
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->sharedCredentials instanceof SharedCredentialsIdentifier) {
            return;
        }

        if (empty($this->username)) {
            $context
                ->buildViolation('Username must not be empty')
                ->atPath('username')
                ->addViolation();
        }

        switch ($this->authenticationType) {
            case self::AUTHENTICATION_PASSWORD:
                if (empty($this->password)) {
                    $context
                        ->buildViolation(
                            'For password authentication the password must not be empty'
                        )
                        ->atPath('password')
                        ->addViolation();
                }
                break;
            case self::AUTHENTICATION_KEY_WITHOUT_PASSPHRASE:
                if (empty($this->key)) {
                    $context
                        ->buildViolation(
                            'For key authentication the key must not be empty'
                        )
                        ->atPath('key')
                        ->addViolation();
                }
                break;
            case self::AUTHENTICATION_KEY_WITH_PASSPHRASE:
                if (empty($this->key)) {
                    $context
                        ->buildViolation(
                            'For key authentication the key must not be empty'
                        )
                        ->atPath('key')
                        ->addViolation();
                }
                if (empty($this->passphrase)) {
                    $context
                        ->buildViolation(
                            'For key authentication with passphrase the passphrase must not be empty'
                        )
                        ->atPath('passphrase')
                        ->addViolation();
                }
                break;
        }
    }
}
