<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Recipient;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Types\AtlassianPlugin;
use Reinfi\BambooSpec\Entity\Types\NotificationApplicableTo;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Recipient
 */
abstract class AnyRecipient implements RecipientInterface
{
    abstract protected function getRecipientClass(): string;
    abstract protected function applicableTo(): string;

    /**
     * @Serializer\Expose()
     * @Serializer\VirtualProperty("applicableTo")
     * @Serializer\SerializedName("applicableTo")
     */
    final public function getApplicableTo(): NotificationApplicableTo
    {
        return new NotificationApplicableTo($this->applicableTo());
    }

    /**
     * @Serializer\Expose()
     * @Serializer\VirtualProperty("atlassianPlugin")
     * @Serializer\SerializedName("atlassianPlugin")
     */
    final public function getAtlassianPluginClass(): AtlassianPlugin
    {
        return new AtlassianPlugin($this->getRecipientClass());
    }

    final public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.api.model.notification.AnyNotificationRecipientProperties';
    }
}
