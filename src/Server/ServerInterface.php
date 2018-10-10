<?php

namespace Reinfi\BambooSpec\Server;

use Reinfi\BambooSpec\Entity\SpecEntityInterface;

/**
 * @package Reinfi\BambooSpec\Server
 */
interface ServerInterface
{
    public function publish(SpecEntityInterface $entity): void;
}
