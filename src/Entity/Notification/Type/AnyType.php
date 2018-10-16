<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Notification\Type;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Types\AtlassianPlugin;

/**
 * @package Reinfi\BambooSpec\Entity\Notification\Type
 *
 * @Serializer\ExclusionPolicy("all")
 */
abstract class AnyType implements TypeInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\VirtualProperty("atlassianPlugin")
     * @Serializer\SerializedName("atlassianPlugin")
     */
    public final function getAtlassianPluginClass()
    {
        return new AtlassianPlugin($this->getNotificationClass());
    }

    abstract public function getNotificationClass(): string;

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.api.model.notification.AnyNotificationTypeProperties';
    }
}
