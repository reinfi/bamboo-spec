<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder;

use Reinfi\BambooSpec\Entity\PublishableEntityInterface;

/**
 * @package Reinfi\BambooSpec\Builder
 */
class SpecEntity
{
    /**
     * @var PublishableEntityInterface
     */
    private $rootEntity;

    /**
     * @var string
     */
    private $specModelVersion;

    /**
     * @param PublishableEntityInterface $rootEntity
     */
    public function __construct(PublishableEntityInterface $rootEntity)
    {
        $this->rootEntity = $rootEntity;
        $this->specModelVersion = '6.6.3';
    }
}
