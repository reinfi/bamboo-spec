<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\YamlSerializationVisitor;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class ArrayObjectHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => \ArrayObject::class,
                'method'    => 'serializeArrayObject',
            ],
        ];
    }

    public function serializeArrayObject(
        YamlSerializationVisitor $visitor,
        \ArrayObject $entity,
        array $type,
        Context $context
    ) {
        $visitor->visitArray(
            $entity->getArrayCopy(),
            $type,
            $context
        );
    }
}
