<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Repository;

use Reinfi\BambooSpec\Entity\Traits\WithOid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Repository
 */
abstract class AbstractRepository implements RepositoryInterface
{
    use WithOid;

    /**
     * @var string
     */
    protected $parent;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
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
    public function setParent(string $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return AbstractRepository
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeKey(): string
    {
        return 'repositoryDefinition';
    }
}
