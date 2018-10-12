<?php

namespace Reinfi\BambooSpec\Entity\Task;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class CleanWorkingDirectoryTask extends AbstractTask
{
    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.CleanWorkingDirectoryTaskProperties';
    }
}
