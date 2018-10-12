<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class CommandTask extends AbstractTask
{
    /**
     * Sets label (not a path) of command to be executed. This label must be first
     * defined in the GUI on the Administration/Executables page.
     *
     * @var string
     */
    private $executable;

    /** @var string|null */
    private $argument;

    /** @var string|null */
    private $environmentVariables;

    /** @var string|null */
    private $workingSubdirectory;

    /**
     * @param string $executable
     */
    public function __construct(string $executable)
    {
        $this->executable = $executable;
    }

    /**
     * Sets command line argument to be passed when command is executed.
     *
     * @param string $argument
     *
     * @return self
     */
    public function setArgument(string $argument): self
    {
        $this->argument = $argument;

        return $this;
    }

    /**
     * Sets environment variables to be set when command is executed.
     *
     * @param string $environmentVariables
     *
     * @return self
     */
    public function setEnvironmentVariables(string $environmentVariables): self
    {
        $this->environmentVariables = $environmentVariables;

        return $this;
    }

    /**
     * Sets a directory the command should be executed in.
     *
     * @param string $workingSubdirectory
     *
     * @return self
     */
    public function setWorkingSubdirectory(string $workingSubdirectory): self
    {
        $this->workingSubdirectory = $workingSubdirectory;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.CommandTaskProperties';
    }
}
