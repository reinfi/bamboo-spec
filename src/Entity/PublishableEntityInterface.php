<?php

namespace Reinfi\BambooSpec\Entity;

use Reinfi\BambooSpec\Builder\Interfaces\TypedInterface;

/**
 * @package Reinfi\BambooSpec\Entity
 */
interface PublishableEntityInterface extends TypedInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}
