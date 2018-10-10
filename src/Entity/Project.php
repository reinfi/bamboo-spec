<?php

namespace Reinfi\BambooSpec\Entity;

/**
 * @package Reinfi\BambooSpec\Entity
 */
class Project
{
    /**
     * @var BambooKey
     */
    protected $key;

    /**
     * @var BambooOid
     */
    protected $oid;

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
     * @return BambooOid
     */
    public function getOid(): BambooOid
    {
        return $this->oid;
    }

    /**
     * @param BambooOid $oid
     *
     * @return Project
     */
    public function setOid(BambooOid $oid)
    {
        $this->oid = $oid;

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
