<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

use Reinfi\BambooSpec\Entity\Types\Duration;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
class BranchCleanup
{
    /**
     * @var bool
     */
    private $removeDeletedFromRepository = true;

    /**
     * @var bool
     */
    private $removeInactiveInRepository = true;

    /**
     * @var Duration
     */
    private $removeDeletedFromRepositoryPeriod;

    /**
     * @var Duration
     */
    private $removeInactiveInRepositoryPeriod;

    /**
     */
    public function __construct()
    {
        $this->removeDeletedFromRepository = false;
        $this->removeInactiveInRepository = false;
        $this->removeDeletedFromRepositoryPeriod = Duration::durationZero();
        $this->removeInactiveInRepositoryPeriod = Duration::durationZero();
    }

    /**
     * Enables/disables plan branch removing when branch deleted in repository. Disabled by default.
     *
     * @param bool $removeRemovedFromRepository
     *
     * @return BranchCleanup
     */
    public function whenRemovedFromRepository(bool $removeRemovedFromRepository)
    {
        $this->removeDeletedFromRepository = $removeRemovedFromRepository;

        return $this;
    }

    /**
     * Enables/disables plan branch removing when branch is inactive (no commits) in repository. Disabled by default.
     *
     * @param bool $removeWhenInactiveInRepository
     *
     * @return BranchCleanup
     */
    public function whenInactiveInRepository(
        bool $removeWhenInactiveInRepository
    ) {
        $this->removeInactiveInRepository = $removeWhenInactiveInRepository;

        return $this;
    }

    /**
     * Defines the time after which the branch should be removed. Default is {@link #DEFAULT_REMOVED_BRANCH_EXPIRY}.
     *
     * @param int $whenRemovedFromRepositoryAfterDays
     *
     * @return BranchCleanup
     */
    public function whenRemovedFromRepositoryAfterDays(
        int $whenRemovedFromRepositoryAfterDays
    ) {
        $this->removeDeletedFromRepositoryPeriod = Duration::durationInDays(
            $whenRemovedFromRepositoryAfterDays
        );
        $this->removeDeletedFromRepository = true;

        return $this;
    }

    /**
     * Defines the time after which the branch should be removed in case of inactivity. Default is {@link #DEFAULT_INACTIVE_BRANCH_EXPIRY}.
     *
     * @param int $whenInactiveInRepositoryAfterDays
     *
     * @return BranchCleanup
     */
    public function whenInactiveInRepositoryAfterDays(
        int $whenInactiveInRepositoryAfterDays
    ) {
        $this->removeInactiveInRepositoryPeriod = Duration::durationInDays(
            $whenInactiveInRepositoryAfterDays
        );
        $this->removeInactiveInRepository = true;

        return $this;
    }
}
