<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Identifier\Credentials;

use Reinfi\BambooSpec\Entity\BambooOid;
use Reinfi\BambooSpec\Entity\Traits\WithOid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @package Reinfi\BambooSpec\Entity\Identifier\Credentials
 */
class SharedCredentialsIdentifier
{
    use WithOid;

    /**
     * @var string
     */
    private $name;

    /**
     * @param null|string    $name
     * @param null|BambooOid $oid
     */
    public function __construct(
        ?string $name,
        ?BambooOid $oid = null
    ) {
        $this->name = $name;
        $this->oid = $oid;
    }

    /**
     * @param string $name
     *
     * @return SharedCredentialsIdentifier
     */
    public static function fromName(string $name): self
    {
        return new SharedCredentialsIdentifier($name);
    }

    /**
     * @param BambooOid $oid
     *
     * @return SharedCredentialsIdentifier
     */
    public static function fromOid(BambooOid $oid): self
    {
        return new SharedCredentialsIdentifier(null, $oid);
    }

    /**
     * @Assert\Callback()
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->oid === null && empty($this->name)) {
            $context
                ->buildViolation('Either name or oid need to be defined when referencing shared credentials')
                ->addViolation();
        }
    }
}
