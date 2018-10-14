<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan;

use JMS\Serializer\Annotation as Serializer;
use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Reinfi\BambooSpec\Entity\Identifier\Plan\PlanIdentifier;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Plan
 */
class Dependencies
{
    /**
     * @Assert\Valid()
     *
     * @Serializer\SerializedName("dependenciesConfigurationProperties")
     *
     * @var DependenciesConfiguration
     */
    private $dependenciesConfiguration;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    private $childPlans;

    /**
     */
    public function __construct()
    {
        $this->childPlans = new Sequence();
        $this->dependenciesConfiguration = new DependenciesConfiguration();
    }

    /**
     * @param DependenciesConfiguration $configuration
     *
     * @return Dependencies
     */
    public function setConfiguration(DependenciesConfiguration $configuration): self
    {
        $this->dependenciesConfiguration = $configuration;

        return $this;
    }

    /**
     * @param PlanIdentifier $plan
     *
     * @return Dependencies
     */
    public function addChildPlan(PlanIdentifier $plan): self
    {
        $this->childPlans->add($plan);

        return $this;
    }

    /**
     * @param PlanIdentifier ...$plans
     *
     * @return Dependencies
     */
    public function withChildPlans(PlanIdentifier ...$plans): self
    {
        $this->childPlans->addAll($plans);

        return $this;
    }
}
