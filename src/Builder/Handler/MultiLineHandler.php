<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Entity\Types\MultiLine;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class MultiLineHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => MultiLine::class,
                'method'    => 'serializeMultiLine',
            ],
        ];
    }

    public function serializeMultiLine(
        YamlSerializationVisitor $visitor,
        MultiLine $multiLine
    ) {
        $value = $multiLine->getContent();

        $visitor->writer->rtrim(false);
        $visitor->writer->writeln(' |-');
        $visitor->writer->indent();

        foreach (preg_split('/\n|\r\n/', $value) as $row) {
            $visitor->writer->writeln($row);
        }

        $visitor->writer->outdent();
    }
}
