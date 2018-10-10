<?php

namespace Reinfi\BambooSpec\Builder;

use Reinfi\BambooSpec\Entity\SpecEntityInterface;

/**
 * @package Reinfi\BambooSpec\Builder
 */
class SpecEntity
{
    /**
     * @var SpecEntityInterface
     */
    private $rootEntity;

    /**
     * @var string
     */
    private $specModelVersion;

    /**
     * @param SpecEntityInterface $rootEntity
     */
    public function __construct(
        SpecEntityInterface $rootEntity
    ) {
        $this->rootEntity = $rootEntity;
        $this->specModelVersion = '6.6.3';
    }

    /**
     * @return SpecEntityInterface
     */
    public function getRootEntity(): SpecEntityInterface
    {
        return $this->rootEntity;
    }

    /**
     * @return string
     */
    public function getSpecModelVersion(): string
    {
        return $this->specModelVersion;
    }
}
