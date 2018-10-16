<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Entity\Types\NotificationApplicableTo;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class NotificationApplicableToHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => NotificationApplicableTo::class,
                'method'    => 'serialize',
            ],
        ];
    }

    public function serialize(
        YamlSerializationVisitor $visitor,
        NotificationApplicableTo $applicableTo
    ) {
        $visitor->writer->rtrim(false);
        $visitor->writer->writeln(' !!set');

        $visitor->writer->writeln(
            sprintf(
                "!!com.atlassian.bamboo.specs.api.builders.Applicability '%s': null",
                $applicableTo->getApplicableTo()
            )
        );
    }
}
