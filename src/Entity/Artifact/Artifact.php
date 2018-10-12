<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Artifact;

/**
 * @package Reinfi\BambooSpec\Entity\Artifact
 */
class Artifact
{
    /** @var string */
    private $name;

    /** @var string */
    private $copyPattern;

    /** @var string */
    private $location = "";

    /** @var bool */
    private $shared = false;

    /** @var bool */
    private $required = false;

    /**
     * @param string $name
     * @param string $copyPattern
     */
    public function __construct(string $name, string $copyPattern)
    {
        $this->name = $name;
        $this->copyPattern = $copyPattern;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Specify the directory (relative path) to find your artifact. e.g. target
     *
     * @param string $location
     *
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Make the artifact available to be used in other builds and deployments.
     *
     * @param bool $shared
     *
     * @return self
     */
    public function setShared(bool $shared): self
    {
        $this->shared = $shared;

        return $this;
    }

    /**
     * Build fails if the artifact cannot be published.
     *
     * @param bool $required
     *
     * @return self
     */
    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }
}
