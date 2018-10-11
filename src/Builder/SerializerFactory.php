<?php

namespace Reinfi\BambooSpec\Builder;

use JMS\Serializer\EventDispatcher\EventDispatcherInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Reinfi\BambooSpec\Builder\Handler\ArrayObjectHandler;
use Reinfi\BambooSpec\Builder\Handler\DurationHandler;
use Reinfi\BambooSpec\Builder\Handler\MultiLineHandler;
use Reinfi\BambooSpec\Builder\Handler\SpecEntityHandler;
use Reinfi\BambooSpec\Builder\Handler\TypedInterfaceHandler;
use Reinfi\BambooSpec\Builder\Listener\ArrayObjectSubscriber;
use Reinfi\BambooSpec\Builder\Listener\TypedInterfaceSubscriber;

/**
 * @package Reinfi\BambooSpec\Builder
 */
class SerializerFactory
{
    public function create(): SerializerInterface
    {
        $serializerBuilder = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->addDefaultListeners()
            ->setPropertyNamingStrategy(
                new SerializedNameAnnotationStrategy(
                    new IdenticalPropertyNamingStrategy()
                )
            )
            ->addDefaultSerializationVisitors();

        $serializerBuilder->configureListeners(
            function (EventDispatcherInterface $dispatcher) {
                $dispatcher->addSubscriber(new TypedInterfaceSubscriber());
            }
        );

        $serializerBuilder->configureHandlers(
            function (HandlerRegistry $handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(new ArrayObjectHandler());
                $handlerRegistry->registerSubscribingHandler(new DurationHandler());
                $handlerRegistry->registerSubscribingHandler(new MultiLineHandler());
                $handlerRegistry->registerSubscribingHandler(new SpecEntityHandler());
                $handlerRegistry->registerSubscribingHandler(new TypedInterfaceHandler());
            }
        );

        return $serializerBuilder->build();
    }
}
