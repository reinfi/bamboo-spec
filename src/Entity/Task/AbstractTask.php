<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
abstract class AbstractTask implements TaskInterface
{
    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var string
     */
    protected $description = "";

    /**
     * @return AbstractTask
     */
    public function enable(): self
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return AbstractTask
     */
    public function disable(): self
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return AbstractTask
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
