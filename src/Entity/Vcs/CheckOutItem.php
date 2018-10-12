<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Vcs;

/**
 * @package Reinfi\BambooSpec\Entity\Vcs
 */
class CheckOutItem
{
    /** @var VcsRepositoryIdentifier */
    private $repository;

    /** @var bool */
    private $defaultRepository;

    /** @var string */
    private $path = "";

    /**
     * Sets this checkout request for a particular repository.
     *
     * @param VcsRepositoryIdentifier $repository
     *
     * @return self
     */
    public function setRepository(VcsRepositoryIdentifier $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Sets this checkout request for plan's default repository.
     * Default repository is the repository which is the first on the list of plan's repositories.
     *
     * @return self
     */
    public function useDefaultRepository(): self
    {
        $this->defaultRepository = true;

        return $this;
    }

    /**
     * Sets the path the repository should be checked out to.
     * The path must be relative to the working directory.
     * Empty by default.
     *
     * @param string $path
     *
     * @return self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
