<?php

namespace Reinfi\BambooSpec\Builder\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use Reinfi\BambooSpec\Builder\Interfaces\TypedInterface;

/**
 * @package Reinfi\BambooSpec\Builder\Listener
 */
class TypedInterfaceSubscriber implements EventSubscriberInterface
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

        if (!$object instanceof TypedInterface) {
            return;
        }

        if ($this->mappedObjects->contains($object)) {
            return;
        }

        $this->mappedObjects->attach($object);

        $event->setType(TypedInterface::class);
    }

    public static function getSubscribedEvents()
    {
        return [
            [ 'event' => 'serializer.pre_serialize', 'method' => 'onPreSerialize' ],
        ];
    }

}
