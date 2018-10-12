<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class DumpVariablesTask extends AbstractTask
{
    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.DumpVariablesTaskProperties';
    }
}
