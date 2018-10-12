<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
class GulpTask extends AbstractNodeTask
{
    private const GULP_EXECUTABLE_DEFAULT = 'node_modules/gulp/bin/gulp.js';

    /** @var string */
    protected $gulpExecutable = self::GULP_EXECUTABLE_DEFAULT;

    /** @var string */
    protected $task;

    /** @var string */
    protected $gulpfile;

    /**
     * @param string $nodeExecutable
     * @param string $gulpExecutable
     */
    public function __construct(
        string $nodeExecutable,
        string $gulpExecutable = self::GULP_EXECUTABLE_DEFAULT
    ) {
        parent::__construct($nodeExecutable);

        $this->gulpExecutable = $gulpExecutable;
    }

    /**
     * Specify path to the Gulp executable for this task.
     * Path must be relative to the working directory.
     *
     * @param string $gulpExecutable
     *
     * @return GulpTask
     */
    public function setGulpExecutable(string $gulpExecutable)
    {
        $this->gulpExecutable = $gulpExecutable;

        return $this;
    }

    /**
     * Gulp task to execute. If not specified, the 'default' task will be executed.
     * You can specify multiple tasks separated by a space.
     *
     * @param string $task
     *
     * @return GulpTask
     */
    public function setTask(string $task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Specify path to the gulpfile, relative to the build working directory.
     * Leave blank to use the default. Only supported for Gulp 3.3.2 or newer.
     *
     * @param string $gulpfile
     *
     * @return GulpTask
     */
    public function setGulpfile(string $gulpfile)
    {
        $this->gulpfile = $gulpfile;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.GulpTaskProperties';
    }
}
