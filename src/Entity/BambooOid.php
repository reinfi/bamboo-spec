<?php

namespace Reinfi\BambooSpec\Entity;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class BambooOid
{
    /**
     * @var string
     */
    protected $oid;

    /**
     * @param string $oid
     */
    public function __construct(string $oid)
    {
        $this->oid = $oid;
    }
}
