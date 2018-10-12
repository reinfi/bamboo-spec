<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Builder\Interfaces\TypedInterface;
use Reinfi\BambooSpec\Builder\Interfaces\TypedKeyInterface;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class TypedInterfaceHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => TypedInterface::class,
                'method'    => 'serialize',
            ],
        ];
    }

    public function serialize(
        YamlSerializationVisitor $visitor,
        TypedInterface $entity,
        array $type,
        SerializationContext $context
    ) {
        $visitor->writer->rtrim(false);

        if ($entity instanceof TypedKeyInterface) {
            $visitor->writer->write(' ' . $entity->getTypeKey() . ':');
        }

        $visitor->writer->writeln(' !!' . $entity->getJavaClass());

        $context->stopVisiting($entity);

        $visitor->getNavigator()->accept(
            $entity,
            [
                'name' => get_class($entity),
            ],
            $context
        );

        $context->startVisiting($entity);
    }
}
