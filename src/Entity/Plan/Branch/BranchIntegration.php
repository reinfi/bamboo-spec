<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

use Reinfi\BambooSpec\Entity\Identifier\Plan\PlanBranchIdentifier;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
class BranchIntegration
{
    /**
     * @var bool
     */
    private $enabled = true;

    /**
     * @var PlanBranchIdentifier
     */
    private $integrationBranch;

    /**
     * @var bool
     */
    private $gatekeeper;

    /**
     * @var bool
     */
    private $pushOn;

    /**
     */
    public function __construct()
    {
        $this->enabled = false;
        $this->integrationBranch = null;
        $this->gatekeeper = false;
        $this->pushOn = false;
    }

    /**
     * Enables/disables automatic branch merging. Enabled by default.
     *
     * @param bool $enabled
     *
     * @return BranchIntegration
     */
    public function enabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Sets integration branch identifier.
     * <p>
     * If both oid and key is defined by the identifier, key is ignored.
     *
     * @param PlanBranchIdentifier $integrationBranch
     *
     * @return BranchIntegration
     */
    public function integrationBranch(
        PlanBranchIdentifier $integrationBranch
    ): self {
        $this->integrationBranch = $integrationBranch;

        return $this;
    }

    /**
     * Selects merging strategy. If true, the integration branch is the target
     * branch of the merge and, possibly, the push. If false, the integration
     * branch is the source branch of the merge, and current branch is the target.
     *
     * Default is false (current branch is the target of the merge).
     *
     * @param bool $gatekeeper
     *
     * @return BranchIntegration
     */
    public function gatekeeper(bool $gatekeeper): self
    {
        $this->gatekeeper = $gatekeeper;

        return $this;
    }

    /**
     * Enables/disables executing push on successful build. The target branch is selected by setting {@link #gatekeeper(boolean)} option.
     * Feature is turned off by default.
     *
     * @param bool $push
     *
     * @return BranchIntegration
     */
    public function pushOnSuccessfulBuild(bool $push): self
    {
        $this->pushOn = $push;

        return $this;
    }
}
