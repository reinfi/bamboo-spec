<?php

namespace Reinfi\BambooSpec\Entity;

/**
 * @package Reinfi\BambooSpec\Entity
 */
interface SpecEntityInterface
{
    /**
     * Matching class of bamboo java spec.
     *
     * @return string
     */
    public function getJavaClass(): string;

    /**
     * Representation of entity for human readability.
     *
     * @return string
     */
    public function getHumanReadableId(): string;
}
