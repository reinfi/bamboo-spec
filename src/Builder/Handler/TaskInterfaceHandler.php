<?php

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Entity\Task\TaskInterface;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class TaskInterfaceHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => TaskInterface::class,
                'method'    => 'serializeTask',
            ],
        ];
    }

    public function serializeTask(
        YamlSerializationVisitor $visitor,
        TaskInterface $entity,
        array $type,
        SerializationContext $context
    ) {
        $visitor->writer->rtrim(false);
        $visitor->writer->writeln(' !!' . $entity->getJavaClass());

        $context->stopVisiting($entity);

        $visitor->getNavigator()->accept(
            $entity,
            [
                'name' => get_class($entity)
            ],
            $context
        );

        $context->startVisiting($entity);
    }
}
