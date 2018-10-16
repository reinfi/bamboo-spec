<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class GroupRecipient implements RecipientInterface
{
    /**
     * @var string
     */
    private $groupName;

    /**
     * @param string $groupName
     */
    public function __construct(string $groupName)
    {
        $this->groupName = $groupName;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.GroupRecipientProperties';
    }
}
