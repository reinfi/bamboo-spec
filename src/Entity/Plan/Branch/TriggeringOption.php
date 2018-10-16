<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
abstract class TriggeringOption
{
    public const INHERITED = 'INHERITED';
    public const MANUAL = 'MANUAL';
}
