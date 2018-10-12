<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity;

use Reinfi\BambooSpec\Entity\Traits\WithOid;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Project
{
    use WithOid;

    /**
     * @var BambooKey
     */
    protected $key;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @param BambooKey $key
     * @param string    $name
     */
    public function __construct(BambooKey $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * @return BambooKey
     */
    public function getKey(): BambooKey
    {
        return $this->key;
    }

    /**
     * @param BambooKey $key
     *
     * @return Project
     */
    public function setKey(BambooKey $key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
