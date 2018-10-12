<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Server;

use Reinfi\BambooSpec\Entity\PublishableEntityInterface;

/**
 * @package Reinfi\BambooSpec\Server
 */
interface ServerInterface
{
    public function publish(PublishableEntityInterface $entity): void;
}
