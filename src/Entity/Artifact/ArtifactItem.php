<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Artifact;

use Reinfi\BambooSpec\Entity\Identifier\Plan\PlanIdentifier;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Artifact
 */
class ArtifactItem
{
    /**
     * @var bool
     */
    private $allArtifacts = true;

    /**
     * @var string
     */
    private $artifactName;

    /**
     * @Assert\Valid()
     *
     * @var PlanIdentifier
     */
    private $sourcePlan;

    public static function fromName(string $artifactName): self
    {
        return (new ArtifactItem())->withArtifactName($artifactName);
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
     * @param PlanIdentifier $sourcePlan
     *
     * @return self
     */
    public function setSourcePlan(PlanIdentifier $sourcePlan): self
    {
        $this->sourcePlan = $sourcePlan;

        return $this;
    }
}
