<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class UserRecipient implements RecipientInterface
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @param string $userName
     */
    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.UserRecipientProperties';
    }
}
