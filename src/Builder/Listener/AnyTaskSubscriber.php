<?php

namespace Reinfi\BambooSpec\Builder\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use Reinfi\BambooSpec\Entity\Task\AnyTask;

/**
 * @package Reinfi\BambooSpec\Builder\Listener
 */
class AnyTaskSubscriber implements EventSubscriberInterface
{
    public function onPreSerialize(PreSerializeEvent $event)
    {
        $object = $event->getObject();

        if (!$object instanceof AnyTask) {
            return;
        }

        $event->setType(AnyTask::class);
        $event->stopPropagation();
    }

    public static function getSubscribedEvents()
    {
        return [
            [ 'event' => 'serializer.pre_serialize', 'method' => 'onPreSerialize' ],
        ];
    }
}
