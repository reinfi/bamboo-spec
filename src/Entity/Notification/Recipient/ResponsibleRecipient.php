<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class ResponsibleRecipient extends AnyRecipient
{
    protected function getRecipientClass(): string
    {
        return 'com.atlassian.bamboo.brokenbuildtracker:recipient.responsible';
    }

    protected function applicableTo(): string
    {
        return 'PLANS';
    }
}
