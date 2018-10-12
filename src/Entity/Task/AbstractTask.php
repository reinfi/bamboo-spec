<?php

declare(strict_types=1);

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
