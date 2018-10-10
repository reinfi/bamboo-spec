<?php

namespace Reinfi\BambooSpec\Builder\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use Reinfi\BambooSpec\Entity\Task\TaskInterface;

/**
 * @package Reinfi\BambooSpec\Builder\Listener
 */
class InterfaceTypeSubscriber implements EventSubscriberInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $mappedObjects;

    /**
     */
    public function __construct()
    {
        $this->mappedObjects = new \SplObjectStorage();
    }

    public function onPreSerialize(PreSerializeEvent $event)
    {
        $object = $event->getObject();

        if (!$object instanceof TaskInterface) {
            return;
        }

        if ($this->mappedObjects->contains($object)) {
            return;
        }

        $this->mappedObjects->attach($object);

        $event->setType(TaskInterface::class);
    }

    public static function getSubscribedEvents()
    {
        return [
            [ 'event' => 'serializer.pre_serialize', 'method' => 'onPreSerialize' ],
        ];
    }

}
