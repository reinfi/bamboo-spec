<?php

namespace Reinfi\BambooSpec\Entity\Repository;

use Reinfi\BambooSpec\Entity\Traits\WithOid;

/**
 * @package Reinfi\BambooSpec\Entity\Repository
 */
abstract class AbstractRepository implements RepositoryInterface
{
    use WithOid;

    /** @var string */
    protected $parent;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /*
    protected VcsRepositoryViewerProperties repositoryViewer;
    */

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $parent
     *
     * @return AbstractRepository
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return AbstractRepository
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return AbstractRepository
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeKey(): string
    {
        return 'repositoryDefinition';
    }
}
