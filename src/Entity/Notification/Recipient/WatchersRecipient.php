<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class WatchersRecipient extends AnyRecipient
{
    protected function getRecipientClass(): string
    {
        return 'com.atlassian.bamboo.plugin.system.notifications:recipient.watcher';
    }

    protected function applicableTo(): string
    {
        return 'PLANS';
    }
}
