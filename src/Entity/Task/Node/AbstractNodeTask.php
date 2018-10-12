<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;

use Reinfi\BambooSpec\Entity\Task\AbstractTask;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
abstract class AbstractNodeTask extends AbstractTask
{
    /** @var string */
    protected $nodeExecutable;

    /** @var string */
    protected $environmentVariables;

    /** @var string */
    protected $workingSubdirectory;

    /**
     * @param string $nodeExecutable
     */
    public function __construct(string $nodeExecutable)
    {
        $this->nodeExecutable = $nodeExecutable;
    }

    /**
     * @param string $nodeExecutable
     *
     * @return AbstractNodeTask
     */
    public function setNodeExecutable($nodeExecutable)
    {
        $this->nodeExecutable = $nodeExecutable;

        return $this;
    }

    /**
     * @param string $environmentVariables
     *
     * @return AbstractNodeTask
     */
    public function setEnvironmentVariables($environmentVariables)
    {
        $this->environmentVariables = $environmentVariables;

        return $this;
    }

    /**
     * @param string $workingSubdirectory
     *
     * @return AbstractNodeTask
     */
    public function setWorkingSubdirectory($workingSubdirectory)
    {
        $this->workingSubdirectory = $workingSubdirectory;

        return $this;
    }
}
