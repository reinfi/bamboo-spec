<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity;

use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Reinfi\BambooSpec\Entity\Artifact\Artifact;
use Reinfi\BambooSpec\Entity\Job\Docker\DockerConfiguration;
use Reinfi\BambooSpec\Entity\Job\Requirement\Requirement;
use Reinfi\BambooSpec\Entity\Task\TaskInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Job
{
    /**
     * @Assert\NotNull()
     *
     * @var BambooKey
     */
    protected $key;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = "";

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var bool
     */
    protected $cleanWorkingDirectory = false;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $tasks;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $finalTasks;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $artifacts;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $requirements;

    /**
     * @Assert\Valid()
     *
     * @var DockerConfiguration
     */
    protected $dockerConfiguration;

    /**
     * @param BambooKey $key
     * @param string    $name
     */
    public function __construct(BambooKey $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;

        $this->tasks = new Sequence();
        $this->finalTasks = new Sequence();
        $this->artifacts = new Sequence();
        $this->requirements = new Sequence();
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
     * @param DockerConfiguration $dockerConfiguration
     *
     * @return self
     */
    public function setDockerConfiguration(
        DockerConfiguration $dockerConfiguration
    ): self {
        $this->dockerConfiguration = $dockerConfiguration;

        return $this;
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
        $this->tasks->addAll($tasks);

        return $this;
    }

    public function withFinalTasks(TaskInterface ...$finalTasks): self
    {
        $this->tasks->addAll($finalTasks);

        return $this;
    }

    public function withArtifacts(Artifact ...$artifacts): self
    {
        $this->artifacts->addAll($artifacts);

        return $this;
    }

    public function withRequirements(Requirement ...$requirements): self
    {
        $this->requirements->addAll($requirements);

        return $this;
    }
}
