<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
class NpmTask extends AbstractNodeTask
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $command;

    /**
     * @var bool
     */
    protected $useIsolatedCache;

    /**
     * @param string $nodeExecutable
     * @param string $command
     */
    public function __construct(
        string $nodeExecutable,
        string $command
    ) {
        parent::__construct($nodeExecutable);

        $this->command = $command;
    }

    /**
     * @param string $command
     *
     * @return NpmTask
     */
    public function setCommand(string $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @param bool $useIsolatedCache
     *
     * @return NpmTask
     */
    public function setUseIsolatedCache(bool $useIsolatedCache)
    {
        $this->useIsolatedCache = $useIsolatedCache;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.NpmTaskProperties';
    }
}
