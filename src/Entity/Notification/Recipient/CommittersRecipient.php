<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class CommittersRecipient extends AnyRecipient
{
    protected function getRecipientClass(): string
    {
        return 'com.atlassian.bamboo.plugin.system.notifications:recipient.committer';
    }

    protected function applicableTo(): string
    {
        return 'PLANS';
    }
}
