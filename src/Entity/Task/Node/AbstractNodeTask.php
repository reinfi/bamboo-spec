<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Node;

use Reinfi\BambooSpec\Entity\Task\AbstractTask;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Node
 */
abstract class AbstractNodeTask extends AbstractTask
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $nodeExecutable;

    /**
     * @var string
     */
    protected $environmentVariables;

    /**
     * @var string
     */
    protected $workingSubdirectory;

    /**
     * @param string $nodeExecutable
     */
    public function __construct(string $nodeExecutable)
    {
        $this->nodeExecutable = $nodeExecutable;
    }

    /**
     * @param string $environmentVariables
     *
     * @return AbstractNodeTask
     */
    public function setEnvironmentVariables(string $environmentVariables): self
    {
        $this->environmentVariables = $environmentVariables;

        return $this;
    }

    /**
     * @param string $workingSubdirectory
     *
     * @return AbstractNodeTask
     */
    public function setWorkingSubdirectory(string $workingSubdirectory): self
    {
        $this->workingSubdirectory = $workingSubdirectory;

        return $this;
    }
}
