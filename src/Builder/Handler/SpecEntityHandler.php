<?php

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Builder\SpecEntity;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class SpecEntityHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => SpecEntity::class,
                'method'    => 'serializeSpecEntity',
            ],
        ];
    }

    public function serializeSpecEntity(
        YamlSerializationVisitor $visitor,
        SpecEntity $entity,
        array $type,
        Context $context
    ) {
        $visitor->writer->writeln('rootEntity: !!' . $entity->getRootEntity()->getJavaClass());
        $visitor->writer->indent();
        $visitor->getNavigator()->accept(
            $entity->getRootEntity(),
            null,
            $context
        );
        $visitor->writer->outdent();

        $visitor->visitArray(
            [
                'specModelVersion' => $entity->getSpecModelVersion(),
            ],
            $type,
            $context
        );
    }
}
