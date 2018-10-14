<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Plan
 */
class DependenciesConfiguration
{
    /**
     * @var bool
     */
    private $enabledForBranches = true;

    /**
     * @var bool
     */
    private $requireAllStagesPassing = false;

    /**
     * @Assert\Choice({"NONE", "BLOCK_IF_PARENT_IN_PROGRESS", "BLOCK_IF_PARENT_HAS_CHANGES"})
     *
     * @var string
     */
    private $blockingStrategy = DependencyBlockingStrategy::NONE;


    /**
     * Enables/disables dependencies support for plan branches. Feature is off by default.
     *
     * @param bool $enabledForBranches
     *
     * @return DependenciesConfiguration
     */
    public function enabledForBranches(bool $enabledForBranches): self
    {
        $this->enabledForBranches = $enabledForBranches;

        return $this;
    }

    /**
     * Controls whether it is required for all stages to be complete before triggering dependant plans.
     * It is only relevant if plan contains manual stages. Feature is off by default.
     *
     * @param bool $requireAllStagesPassing
     *
     * @return DependenciesConfiguration
     */
    public function requireAllStagesPassing(bool $requireAllStagesPassing): self
    {
        $this->requireAllStagesPassing = $requireAllStagesPassing;

        return $this;
    }

    /**
     * Selects dependency blocking strategy. Dependency blocking helps preventing from triggering dependant builds too often.
     * <p>Possible values:
     * <dl>
     * <dt>NONE</dt>
     * <dd>No dependency blocking. Dependant builds are triggered whenever this build finishes successfully.</dd>
     * <dt>BLOCK_IF_PARENT_IN_PROGRESS</dt>
     * <dd>Dependant builds are not triggered if another build of this plan is still running.</dd>
     * <dt>BLOCK_IF_PARENT_HAS_CHANGES</dt>
     * <dd>Dependant builds are not triggered if this plan has unbuilt changes.</dd>
     * </dl>
     *
     * @param string $blockingStrategy
     *
     * @return DependenciesConfiguration
     */
    public function blockingStrategy(string $blockingStrategy): self
    {
        $this->blockingStrategy = $blockingStrategy;

        return $this;
    }
}
