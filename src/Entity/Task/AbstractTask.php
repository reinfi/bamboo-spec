<?php

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
abstract class AbstractTask implements TaskInterface
{
    /** @var bool */
    protected $enabled = true;

    /** @var string */
    protected $description = "";

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return AbstractTask
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

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
     * @return AbstractTask
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
