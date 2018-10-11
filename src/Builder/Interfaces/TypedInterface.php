<?php

namespace Reinfi\BambooSpec\Builder\Interfaces;

/**
 * @package Reinfi\BambooSpec\Builder\Interfaces
 */
interface TypedInterface
{
    /**
     * Matching class of bamboo java spec.
     *
     * @return string
     */
    public function getJavaClass(): string;
}
