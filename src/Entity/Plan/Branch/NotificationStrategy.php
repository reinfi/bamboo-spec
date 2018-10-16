<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
abstract class NotificationStrategy
{
    public const NOTIFY_COMMITTERS = 'NOTIFY_COMMITTERS';
    public const INHERIT = 'INHERIT';
    public const NONE = 'NONE';
}
