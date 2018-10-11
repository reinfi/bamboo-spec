<?php

namespace Reinfi\BambooSpec\Builder\Interfaces;

/**
 * @package Reinfi\BambooSpec\Builder\Interfaces
 */
interface TypedKeyInterface extends TypedInterface
{
    public function getTypeKey(): string;
}
