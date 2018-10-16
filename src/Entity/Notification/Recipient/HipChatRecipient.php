<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class HipChatRecipient implements RecipientInterface
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $apiToken;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $room;

    /**
     * @var bool
     */
    private $notifyUsers = false;

    /**
     * @param string $apiToken
     * @param string $room
     */
    public function __construct(string $apiToken, string $room)
    {
        $this->apiToken = $apiToken;
        $this->room = $room;
    }

    /**
     * @param bool $notifyUsers
     *
     * @return self
     */
    public function setNotifyUsers(bool $notifyUsers): self
    {
        $this->notifyUsers = $notifyUsers;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.HipChatRecipientProperties';
    }
}
