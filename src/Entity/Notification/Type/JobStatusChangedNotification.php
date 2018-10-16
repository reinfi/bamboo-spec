<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Type;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Type
 */
class JobStatusChangedNotification extends AnyType
{
    public function getNotificationClass(): string
    {
        return 'com.atlassian.bamboo.plugin.system.notifications:buildCompleted.changedBuildStatus';
    }
}
