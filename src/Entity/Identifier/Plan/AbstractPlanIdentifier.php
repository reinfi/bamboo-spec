<?php

namespace Reinfi\BambooSpec\Entity\Identifier\Plan;

use Reinfi\BambooSpec\Entity\BambooKey;
use Reinfi\BambooSpec\Entity\BambooOid;
use Reinfi\BambooSpec\Entity\Traits\WithOid;

/**
 * @package Reinfi\BambooSpec\Entity\Identifier\Plan
 */
abstract class AbstractPlanIdentifier
{
    use WithOid;

    /** @var BambooKey */
    protected $key;

    /**
     * @param null|BambooKey $key
     * @param null|BambooOid $oid
     */
    protected function __construct(?BambooKey $key, ?BambooOid $oid = null)
    {
        $this->key = $key;
        $this->oid = $oid;
    }
}
