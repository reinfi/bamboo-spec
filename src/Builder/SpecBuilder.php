<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder;

use Reinfi\BambooSpec\Entity\PublishableEntityInterface;
use Symfony\Component\Yaml\Dumper;

/**
 * @package Reinfi\BambooSpec\Builder
 */
class SpecBuilder
{
    /**
     * @var Dumper
     */
    private $writer;

    /**
     * @var SerializerFactory
     */
    private $serializerFactory;

    /**
     * @param null|Dumper            $writer
     * @param null|SerializerFactory $serializerFactory
     */
    public function __construct(
        ?Dumper $writer = null,
        ?SerializerFactory $serializerFactory = null
    ) {
        $this->writer = $writer ?: new Dumper();
        $this->serializerFactory
            = $serializerFactory ?: new SerializerFactory();
    }

    public function build(PublishableEntityInterface $entity): string
    {
        $specEntity = new SpecEntity($entity);

        $serializer = $this->serializerFactory->create();

        $specYaml = $serializer->serialize($specEntity, 'yml');

        return $specYaml;
    }
}
