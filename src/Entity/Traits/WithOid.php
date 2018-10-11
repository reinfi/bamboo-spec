<?php

namespace Reinfi\BambooSpec\Entity\Traits;

use Reinfi\BambooSpec\Entity\BambooOid;

/**
 * @package Reinfi\BambooSpec\Entity\Traits
 */
trait WithOid
{
    /** @var BambooOid */
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

}
