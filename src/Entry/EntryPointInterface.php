<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entry;

use Reinfi\BambooSpec\Server\ServerInterface;

/**
 * @package Reinfi\BambooSpec\Entry
 */
interface EntryPointInterface
{
    public function configure(ServerInterface $server): void;
}
