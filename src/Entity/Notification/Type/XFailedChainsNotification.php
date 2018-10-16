<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Type;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Type
 */
class XFailedChainsNotification implements TypeInterface
{
    /**
     * @var int
     */
    private $numberOfFailures;

    /**
     * @param int $numberOfFailures
     */
    public function __construct(int $numberOfFailures)
    {
        $this->numberOfFailures = $numberOfFailures;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.XFailedChainsNotificationProperties';
    }
}
