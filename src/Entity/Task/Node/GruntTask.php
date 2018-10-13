<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
class GruntTask extends AbstractNodeTask
{
    private const GRUNT_EXECUTABLE_DEFAULT = 'node_modules/grunt-cli/bin/grunt';

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $gruntCliExecutable = self::GRUNT_EXECUTABLE_DEFAULT;

    /**
     * @var string
     */
    protected $task;

    /**
     * @var string
     */
    protected $gruntfile;

    /**
     * @param string $nodeExecutable
     * @param string $gruntCliExecutable
     */
    public function __construct(
        string $nodeExecutable,
        string $gruntCliExecutable = self::GRUNT_EXECUTABLE_DEFAULT
    ) {
        parent::__construct($nodeExecutable);

        $this->gruntCliExecutable = $gruntCliExecutable;
    }

    /**
     * Specify path to the Grunt command line interface (grunt-cli) executable for this task.
     * Path must be relative to the working directory.
     *
     * @param string $gruntCliExecutable
     *
     * @return GruntTask
     */
    public function setGruntCliExecutable(string $gruntCliExecutable)
    {
        $this->gruntCliExecutable = $gruntCliExecutable;

        return $this;
    }

    /**
     * Grunt task to execute. If not specified, the 'default' task will be executed.
     * Multiple tasks can be specified separated by a space.
     *
     * @param string $task
     *
     * @return GruntTask
     */
    public function setTask(string $task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Specify path to the gruntfile, relative to the build working directory.
     * If empty, the default gruntfile will be used.
     *
     * @param string $gruntfile
     *
     * @return GruntTask
     */
    public function setGruntfile(string $gruntfile)
    {
        $this->gruntfile = $gruntfile;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.GruntTaskProperties';
    }
}
