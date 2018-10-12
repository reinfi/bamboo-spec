<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
class NodeTask extends AbstractNodeTask
{
    /** @var string */
    protected $script;

    /** @var string */
    protected $arguments;

    /**
     * @param string $nodeExecutable
     * @param string $script
     */
    public function __construct(
        string $nodeExecutable,
        string $script
    ) {
        parent::__construct($nodeExecutable);

        $this->script = $script;
    }

    /**
     * @param string $script
     *
     * @return NodeTask
     */
    public function setScript(string $script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * @param string $arguments
     *
     * @return NodeTask
     */
    public function setArguments(string $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.NodeTaskProperties';
    }
}
