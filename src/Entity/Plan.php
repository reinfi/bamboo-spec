<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity;

use Reinfi\BambooSpec\Entity\Repository\RepositoryInterface;
use Reinfi\BambooSpec\Entity\Traits\WithOid;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Plan implements PublishableEntityInterface
{
    use WithOid;

    protected const JAVA_CLASS_NAME = 'com.atlassian.bamboo.specs.api.model.plan.PlanProperties';

    /** @var BambooKey */
    protected $key;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description = "";

    /** @var Project */
    protected $project;

    /**
     * @var \ArrayObject
     */
    protected $stages;

    /**
     * @var \ArrayObject
     */
    protected $repositories;

    /*
    protected List<TriggerProperties> triggers = new ArrayList<>();
    protected List<VariableProperties> variables = new ArrayList<>();
    */

    /** @var bool */
    protected $enabled = true;

    /*
    protected PlanBranchManagementProperties planBranchManagement;
    protected DependenciesProperties dependencies;
    protected Map<String, PluginConfigurationProperties> pluginConfigurations = new LinkedHashMap<>()
    protected List<NotificationProperties> notifications = new ArrayList<>();
    */

    /** @var null|bool */
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

        $this->stages = new \ArrayObject();
        $this->repositories = new \ArrayObject();
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

    public function withStages(Stage ...$stages): self
    {
        $this->stages->exchangeArray($stages);

        return $this;
    }

    public function withRepository(RepositoryInterface ...$repositories): self
    {
        $this->repositories->exchangeArray($repositories);

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
