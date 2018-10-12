<?php

namespace Reinfi\BambooSpec\Entity\Task;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Types\AtlassianPlugin;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 *
 * @Serializer\ExclusionPolicy("all")
 */
abstract class AnyTask extends AbstractTask
{
    abstract protected function getTaskClass(): string;

    /**
     * @Serializer\Expose()
     * @Serializer\VirtualProperty("atlassianPlugin")
     * @Serializer\SerializedName("atlassianPlugin")
     */
    public final function getAtlassianPluginClass()
    {
        return new AtlassianPlugin($this->getTaskClass());
    }

    /**
     * @Serializer\Expose()
     * @Serializer\VirtualProperty("configuration")
     * @Serializer\SerializedName("configuration")
     */
    public final function getConfiguration(): array
    {
        $reflectionClass = new \ReflectionClass($this);
        $properties = array_filter(
            $reflectionClass->getProperties(),
            function (\ReflectionProperty $property) use ($reflectionClass) {
                $propertyClassName = $property->getDeclaringClass()->getName();

                return $propertyClassName === $reflectionClass->getName();
            }
        );

        $configuration = [];

        array_map(
            function (\ReflectionProperty $property) use (&$configuration) {
                $property->setAccessible(true);
                $configuration[$property->getName()] = $property->getValue($this);
            },
            $properties
        );

        return $configuration;
    }

    public final function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.api.model.task.AnyTaskProperties';
    }
}
