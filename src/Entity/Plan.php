<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity;

use JMS\Serializer\Annotation as Serializer;
use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Reinfi\BambooSpec\Entity\Plan\Branch\PlanBranchManagement;
use Reinfi\BambooSpec\Entity\Plan\Dependencies;
use Reinfi\BambooSpec\Entity\Repository\RepositoryInterface;
use Reinfi\BambooSpec\Entity\Traits\WithOid;
use Reinfi\BambooSpec\Entity\Types\Variable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Plan implements PublishableEntityInterface
{
    use WithOid;

    protected const JAVA_CLASS_NAME = 'com.atlassian.bamboo.specs.api.model.plan.PlanProperties';

    /**
     * @Assert\NotNull()
     *
     * @var BambooKey
     */
    protected $key;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = "";

    /**
     * @Assert\NotNull()
     *
     * @var Project
     */
    protected $project;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $stages;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $repositories;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $variables;

    /*
    protected List<TriggerProperties> triggers = new ArrayList<>();
    */

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @Assert\Valid()
     * @Serializer\SerializedName("planBranchManagementProperties")
     *
     * @var PlanBranchManagement
     */
    protected $planBranchManagement;

    /**
     * @Assert\Valid()
     * @Serializer\SerializedName("dependenciesProperties")
     *
     * @var Dependencies
     */
    protected $dependencies;

    /*
    protected Map<String, PluginConfigurationProperties> pluginConfigurations = new LinkedHashMap<>()
    protected List<NotificationProperties> notifications = new ArrayList<>();
    */

    /**
     * @var null|bool
     */
    protected $forceStopHungBuilds = null;

    /**
     * @param BambooKey $key
     * @param string    $name
     * @param Project   $project
     */
    public function __construct(BambooKey $key, string $name, Project $project)
    {
        $this->key = $key;
        $this->name = $name;
        $this->project = $project;

        $this->stages = new Sequence();
        $this->repositories = new Sequence();
        $this->variables = new Sequence();
    }

    /**
     * @return BambooKey
     */
    public function getKey(): BambooKey
    {
        return $this->key;
    }

    /**
     * @param BambooKey $key
     *
     * @return Plan
     */
    public function setKey(BambooKey $key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Plan
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Plan
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     *
     * @return Plan
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @param Dependencies $dependencies
     *
     * @return self
     */
    public function setDependencies(Dependencies $dependencies): self
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * Specifies plan branch management options for this plan. These options control if and how Bamboo should perform automatic branch management.
     *
     * @param PlanBranchManagement $planBranchManagement
     *
     * @return self
     */
    public function setPlanBranchManagement(
        PlanBranchManagement $planBranchManagement
    ): self {
        $this->planBranchManagement = $planBranchManagement;

        return $this;
    }

    /**
     * @param Stage ...$stages
     *
     * @return Plan
     */
    public function withStages(Stage ...$stages): self
    {
        $this->stages->addAll($stages);

        return $this;
    }

    /**
     * @param RepositoryInterface ...$repositories
     *
     * @return Plan
     */
    public function withRepository(RepositoryInterface ...$repositories): self
    {
        $this->repositories->addAll($repositories);

        return $this;
    }

    /**
     * @param Variable ...$variables
     *
     * @return Plan
     */
    public function withVariables(Variable ...$variables): self
    {
        $this->variables->addAll($variables);

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return Plan
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getForceStopHungBuilds(): ?bool
    {
        return $this->forceStopHungBuilds;
    }

    /**
     * @param bool|null $forceStopHungBuilds
     *
     * @return Plan
     */
    public function setForceStopHungBuilds($forceStopHungBuilds)
    {
        $this->forceStopHungBuilds = $forceStopHungBuilds;

        return $this;
    }

    public function getJavaClass(): string
    {
        return self::JAVA_CLASS_NAME;
    }

    public function __toString(): string
    {
        return sprintf(
            "%s %s-%s",
            'Plan',
            $this->project->getKey()->getKey(),
            $this->key->getKey()
        );
    }
}
