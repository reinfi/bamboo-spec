<?php

namespace Reinfi\BambooSpec\Entity\Download;

use Reinfi\BambooSpec\Entity\Artifact\Artifact;

/**
 * @package Reinfi\BambooSpec\Entity\Artifact
 */
class DownloadItem
{
    /** @var bool */
    private $allArtifacts = true;

    /** @var string */
    private $artifactName;

    /** @var string */
    private $path = '';

    public static function fromName(string $artifactName): self
    {
        return (new DownloadItem())->withArtifactName($artifactName);
    }

    public static function fromArtifact(Artifact $artifact): self
    {
        return self::fromName($artifact->getName());
    }

    /**
     * @return self
     */
    public function withAllArtifacts(): self
    {
        $this->allArtifacts = true;
        $this->artifactName = null;

        return $this;
    }

    /**
     * @param string $artifactName
     *
     * @return self
     */
    public function withArtifactName(string $artifactName): self
    {
        $this->artifactName = $artifactName;
        $this->allArtifacts = false;

        return $this;
    }

    /**
     * Specifies the path artifact should be downloaded to.
     * The path can be both absolute and relative to the build working directory.
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
