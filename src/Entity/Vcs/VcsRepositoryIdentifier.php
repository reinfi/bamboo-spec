<?php

namespace Reinfi\BambooSpec\Entity\Vcs;

use Reinfi\BambooSpec\Entity\BambooOid;
use Reinfi\BambooSpec\Entity\Traits\WithOid;

/**
 * @package Reinfi\BambooSpec\Entity\Vcs
 */
class VcsRepositoryIdentifier
{
    use WithOid;

    /** @var string|null */
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

    public static function fromName(string $name): VcsRepositoryIdentifier
    {
        return new self($name);
    }
}
