<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
class InstantMessengerRecipient implements RecipientInterface
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     * @var string
     */
    private $imAddress;

    /**
     * @param string $imAddress
     */
    public function __construct(string $imAddress)
    {
        $this->imAddress = $imAddress;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.ImRecipientProperties';
    }
}
