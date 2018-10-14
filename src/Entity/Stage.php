<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity;

use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Stage
{
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
    protected $description;

    /**
     * @var bool
     */
    protected $manualStage = false;

    /**
     * @var bool
     */
    protected $finalStage = false;

    /**
     * @Assert\Valid()
     *
     * @var SequenceInterface
     */
    protected $jobs;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->jobs = new Sequence();
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
     * @return Stage
     */
    public function setName(string $name)
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
     * @return Stage
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isManualStage(): bool
    {
        return $this->manualStage;
    }

    /**
     * @param bool $manualStage
     *
     * @return Stage
     */
    public function setManualStage(bool $manualStage)
    {
        $this->manualStage = $manualStage;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinalStage(): bool
    {
        return $this->finalStage;
    }

    /**
     * @param bool $finalStage
     *
     * @return Stage
     */
    public function setFinalStage(bool $finalStage)
    {
        $this->finalStage = $finalStage;

        return $this;
    }

    /**
     * @param Job ...$jobs
     *
     * @return Stage
     */
    public function withJobs(Job ...$jobs): self
    {
        $this->jobs->addAll($jobs);

        return $this;
    }
}
