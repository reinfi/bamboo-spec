<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
class PlanBranchManagement
{
    /**
     * @Assert\Valid()
     *
     * @var CreatePlanBranches
     */
    private $createPlanBranch;

    /**
     * @Assert\Valid()
     *
     * @var BranchCleanup
     */
    private $deletePlanBranch;

    /**
     * @Assert\Choice({"INHERITED", "MANUAL"})
     *
     * @var string
     */
    private $triggeringOption = TriggeringOption::INHERITED;

    /**
     * @Assert\Choice({"NONE", "INHERIT", "NOTIFY_COMMITTERS"})
     *
     * @var string
     */
    private $notificationStrategy = NotificationStrategy::NONE;

    /**
     * @Assert\Valid()
     * @Serializer\SerializedName("branchIntegrationProperties")
     *
     * @var BranchIntegration
     */
    private $branchIntegration;

    /**
     * @var bool
     */
    private $issueLinkingEnabled = true;

    /**
     */
    public function __construct()
    {
        $this->createPlanBranch = new CreatePlanBranches();
        $this->deletePlanBranch = new BranchCleanup();
        $this->branchIntegration = new BranchIntegration();
    }

    /**
     * Disable automatic plan branch creation.
     *
     * @return self
     */
    public function createManually(): self
    {
        $this->createPlanBranch = new CreatePlanBranches(
            CreatePlanBranches::TRIGGER_MANUAL, null
        );

        return $this;
    }

    /**
     * Create new plan branches for new pull requests.
     *
     * @return self
     */
    public function createForPullRequest(): self
    {
        $this->createPlanBranch = new CreatePlanBranches(
            CreatePlanBranches::TRIGGER_PULL_REQUEST, null
        );

        return $this;
    }

    /**
     * Create new plan branches for new branches in default repository.
     *
     * @return self
     */
    public function createForVcsBranch(): self
    {
        $this->createPlanBranch = new CreatePlanBranches(
            CreatePlanBranches::TRIGGER_BRANCH, null
        );

        return $this;
    }

    /**
     * Create new plan branches for new branches with name which matches pattern.
     *
     * @param string $pattern regexp to match branch name
     *
     * @return self
     */
    public function createForVcsBranchMatching(string $pattern): self
    {
        $this->createPlanBranch = new CreatePlanBranches(
            CreatePlanBranches::TRIGGER_BRANCH, $pattern
        );

        return $this;
    }

    /**
     * Sets configuration of automatic removal of branches. The feature is turned off by default.
     *
     * @param BranchCleanup $branchCleanup
     *
     * @return PlanBranchManagement
     */
    public function delete(BranchCleanup $branchCleanup): self
    {
        $this->deletePlanBranch = $branchCleanup;

        return $this;
    }

    /**
     * Create plan branch can only be triggered manually only.
     *
     * @return PlanBranchManagement
     */
    public function triggerBuildsManually(): self
    {
        $this->triggeringOption = TriggeringOption::MANUAL;

        return $this;
    }

    /**
     * Created plan branch will use the same triggers as master plan.
     *
     * @return PlanBranchManagement
     */
    public function triggerBuildsLikeParentPlan(): self
    {
        $this->triggeringOption = TriggeringOption::INHERITED;

        return $this;
    }

    /**
     * All committers and people who have favourited the branch will be notified for all build failures and the first successful build.
     *
     * @return PlanBranchManagement
     */
    public function notificationForCommitters()
    {
        $this->notificationStrategy = NotificationStrategy::NOTIFY_COMMITTERS;

        return $this;
    }

    /**
     * Use the same notification rules as configured for the master plan.
     *
     * @return PlanBranchManagement
     */
    public function notificationLikeParentPlan()
    {
        $this->notificationStrategy = NotificationStrategy::INHERIT;

        return $this;
    }

    /**
     * No notifications will be sent for the created branch.
     *
     * @return PlanBranchManagement
     */
    public function notificationDisabled()
    {
        $this->notificationStrategy = NotificationStrategy::NONE;

        return $this;
    }

    /**
     * Sets default merge strategy for new branches. By default merging is turned off.
     *
     * @param BranchIntegration $branchIntegration
     *
     * @return PlanBranchManagement
     */
    public function branchIntegration(BranchIntegration $branchIntegration): self
    {
        $this->branchIntegration = $branchIntegration;

        return $this;
    }

    /**
     * Enables/disables automatic JIRA issue link creation when new branch is created.
     * Enabled by default.
     *
     * @param bool $issueLinkingEnabled
     *
     * @return PlanBranchManagement
     */
    public function issueLinkingEnabled(bool $issueLinkingEnabled): self
    {
        $this->issueLinkingEnabled = $issueLinkingEnabled;

        return $this;
    }
}
