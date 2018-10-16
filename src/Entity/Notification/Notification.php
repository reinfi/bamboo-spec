<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification;

use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Reinfi\BambooSpec\Entity\Notification\Recipient\RecipientInterface;
use Reinfi\BambooSpec\Entity\Notification\Type\TypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Notification
 */
class Notification
{
    /**
     * @Assert\NotNull()
     * @Assert\Valid()
     *
     * @var TypeInterface
     */
    private $type;

    /**
     * @Assert\Count(min = 1)
     *
     * @var SequenceInterface
     */
    private $recipients;

    /**
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;

        $this->recipients = new Sequence();
    }

    /**
     * @param RecipientInterface $recipient
     *
     * @return Notification
     */
    public function addRecipient(RecipientInterface $recipient): self
    {
        $this->recipients->add($recipient);

        return $this;
    }

    /**
     * @param RecipientInterface ...$recipients
     *
     * @return Notification
     */
    public function addRecipients(RecipientInterface ...$recipients): self
    {
        $this->recipients->addAll($recipients);

        return $this;
    }
}
