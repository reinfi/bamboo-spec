<?php

namespace Reinfi\BambooSpec\Builder\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\YamlSerializationVisitor;
use Reinfi\BambooSpec\Entity\Types\Duration;

/**
 * @package Reinfi\BambooSpec\Builder\Handler
 */
class DurationHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'yml',
                'type'      => Duration::class,
                'method'    => 'serialize',
            ],
        ];
    }

    public function serialize(
        YamlSerializationVisitor $visitor,
        Duration $duration
    ) {
        $isoValue = $this->toIso8601($duration->getSeconds());

        $visitor->writer->rtrim(false);
        $visitor->writer->writeln(" !!java.time.Duration '{$isoValue}'");

    }

    private function toIso8601(int $seconds): string
    {
        $h = intval($seconds / 3600);
        $m = intval(($seconds - $h * 3600) / 60);
        $s = $seconds - ($h * 3600 + $m * 60);
        $ret = 'PT';
        if ($h) {
            $ret .= $h . 'H';
        }
        if ($m) {
            $ret .= $m . 'M';
        }
        if ((!$h && !$m) || $s) {
            $ret .= $s . 'S';
        }

        return $ret;
    }
}
