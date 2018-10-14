<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan;

/**
 * @package Reinfi\BambooSpec\Entity\Plan
 */
abstract class DependencyBlockingStrategy
{
    public const NONE = 'NONE';
    public const BLOCK_IF_PARENT_IN_PROGRESS = 'BLOCK_IF_PARENT_IN_PROGRESS';
    public const BLOCK_IF_PARENT_HAS_CHANGES = 'BLOCK_IF_PARENT_HAS_CHANGES';
}
