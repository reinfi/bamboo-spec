<?php

namespace Reinfi\BambooSpec\Entity;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class BambooKey
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
