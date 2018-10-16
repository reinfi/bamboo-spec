<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Type;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Type
 */
class BuildErrorNotification implements TypeInterface
{
    /**
     * @var bool
     */
    private $firstOccurrenceOnly = false;

    public function sendForFirstOccurrenceOnly(): self
    {
        $this->firstOccurrenceOnly = true;

        return $this;
    }

    public function sendForAllErrors(): self
    {
        $this->firstOccurrenceOnly = false;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.notification.BuildErrorNotificationProperties';
    }
}
