<?php

namespace Reinfi\BambooSpec\Entity\Task;

use Reinfi\BambooSpec\Entity\Types\MultiLine;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class ScriptTask extends AbstractTask
{
    public const INTERPRETER_SHELL = 'SHELL';
    public const INTERPRETER_POWERSHELL = 'WINDOWS_POWER_SHELL';
    public const INTERPRETER_BINSH_OR_CMDEXE = 'BINSH_OR_CMDEXE';

    public const LOCATION_INLINE = 'INLINE';
    public const LOCATION_FILE = 'FILE';

    /** @var string */
    private $interpreter = self::INTERPRETER_SHELL;

    /** @var string */
    private $location = self::LOCATION_INLINE;

    /** @var MultiLine */
    private $body;

    /** @var string */
    private $path;

    /** @var string */
    private $argument;

    /** @var string */
    private $environmentVariables;

    /** @var string */
    private $workingSubdirectory;

    /**
     * @param string $interpreter
     *
     * @return ScriptTask
     */
    public function setInterpreter($interpreter)
    {
        $this->interpreter = $interpreter;

        return $this;
    }

    /**
     * @param string $location
     *
     * @return ScriptTask
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function withInterpreterShell(): self
    {
        $this->interpreter = self::INTERPRETER_SHELL;

        return $this;
    }

    public function withInterpreterWindowsPowerShell(): self
    {
        $this->interpreter = self::INTERPRETER_POWERSHELL;

        return $this;
    }

    public function withInterpreterBinSh(): self
    {
        $this->interpreter = self::INTERPRETER_BINSH_OR_CMDEXE;

        return $this;
    }

    public function withInterpreterCmdExe(): self
    {
        $this->interpreter = self::INTERPRETER_BINSH_OR_CMDEXE;

        return $this;
    }

    public function withInlineBody(string $body): self
    {
        $this->location = self::LOCATION_INLINE;
        $this->body = new MultiLine($body);
        $this->path = null;

        return $this;
    }

    public function withInlineBodyFromPath(string $path): self
    {
        $this->withInlineBody(
            file_get_contents($path)
        );

        return $this;
    }

    public function withFileFromPath(string $path): self
    {
        $this->location = self::LOCATION_FILE;
        $this->body = null;
        $this->path = $path;

        return $this;
    }

    /**
     * @param string $argument
     *
     * @return ScriptTask
     */
    public function setArgument($argument)
    {
        $this->argument = $argument;

        return $this;
    }

    /**
     * @param string $environmentVariables
     *
     * @return ScriptTask
     */
    public function setEnvironmentVariables($environmentVariables)
    {
        $this->environmentVariables = $environmentVariables;

        return $this;
    }

    /**
     * @param string $workingSubdirectory
     *
     * @return ScriptTask
     */
    public function setWorkingSubdirectory($workingSubdirectory)
    {
        $this->workingSubdirectory = $workingSubdirectory;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.ScriptTaskProperties';
    }
}
