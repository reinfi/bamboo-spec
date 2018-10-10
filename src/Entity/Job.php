<?php

namespace Reinfi\BambooSpec\Entity;

use Reinfi\BambooSpec\Entity\Task\TaskInterface;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Job
{
    /** @var BambooKey */
    protected $key;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description = "";

    /** @var bool */
    protected $enabled = true;

    /** @var bool */
    protected $cleanWorkingDirectory = false;

    /** @var \ArrayObject */
    protected $tasks;

    /** @var \ArrayObject */
    protected $finalTasks;

    /*
    protected List<ArtifactProperties> artifacts = new ArrayList<>();
    protected List<TaskProperties> tasks = new ArrayList<>();
    protected List<TaskProperties> finalTasks = new ArrayList<>();
    protected List<RequirementProperties> requirements = new ArrayList<>();
    protected List<ArtifactSubscriptionProperties> subscriptions = new ArrayList<>();
    protected Map<String, PluginConfigurationProperties> pluginConfigurations = new LinkedHashMap<>();

    protected DockerConfigurationProperties dockerConfiguration;
    */

    /**
     * @param BambooKey $key
     * @param string    $name
     */
    public function __construct(BambooKey $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;

        $this->tasks = new \ArrayObject();
        $this->finalTasks = new \ArrayObject();
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
     * @return Job
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
     * @return Job
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
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return Job
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCleanWorkingDirectory(): bool
    {
        return $this->cleanWorkingDirectory;
    }

    /**
     * @param bool $cleanWorkingDirectory
     *
     * @return Job
     */
    public function setCleanWorkingDirectory($cleanWorkingDirectory)
    {
        $this->cleanWorkingDirectory = $cleanWorkingDirectory;

        return $this;
    }

    public function withTasks(TaskInterface ...$tasks): self
    {
        $this->tasks->exchangeArray($tasks);

        return $this;
    }

    public function withFinalTasks(TaskInterface ...$finalTasks): self
    {
        $this->tasks->exchangeArray($finalTasks);

        return $this;
    }
}
