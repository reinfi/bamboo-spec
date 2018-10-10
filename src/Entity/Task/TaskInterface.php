<?php

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
interface TaskInterface
{
    /**
     * Matching class of bamboo java spec.
     *
     * @return string
     */
    public function getJavaClass(): string;
}
