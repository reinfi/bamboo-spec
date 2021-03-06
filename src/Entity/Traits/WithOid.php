<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Traits;

use Reinfi\BambooSpec\Entity\BambooOid;

/**
 * @package Reinfi\BambooSpec\Entity\Traits
 */
trait WithOid
{
    /** @var BambooOid|null */
    protected $oid;

    /**
     * @param BambooOid $oid
     *
     * @return self
     */
    public function setOid(BambooOid $oid): self
    {
        $this->oid = $oid;

        return $this;
    }

    /**
     * @return BambooOid|null
     */
    public function getOid(): ?BambooOid
    {
        return $this->oid;
    }
}
