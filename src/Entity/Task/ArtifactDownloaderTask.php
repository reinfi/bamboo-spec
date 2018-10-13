<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task;

use Reinfi\BambooSpec\Entity\Download\DownloadItem;
use Reinfi\BambooSpec\Entity\Identifier\Plan\PlanIdentifier;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class ArtifactDownloaderTask extends AbstractTask
{
    /**
     * @var PlanIdentifier
     */
    private $sourcePlan;

    /**
     * @Assert\Valid()
     *
     * @var \ArrayObject
     */
    private $artifacts;

    /**
     */
    public function __construct()
    {
        $this->artifacts = new \ArrayObject();
    }

    /**
     * Specifies the plan that is the source of the artifacts.
     * If this property is not set, source plan is either the current plan (if the task is used in a job) or the plan
     * associated with the deployment project (if the task is used in a deployment environment).
     *
     * @Assert\Valid()
     *
     * @param PlanIdentifier $sourcePlan
     *
     * @return ArtifactDownloaderTask
     */
    public function setSourcePlan(PlanIdentifier $sourcePlan): self
    {
        $this->sourcePlan = $sourcePlan;

        return $this;
    }

    /**
     * Adds download requests.
     *
     * @param DownloadItem ...$artifacts
     *
     * @return ArtifactDownloaderTask
     */
    public function withArtifacts(DownloadItem ...$artifacts): self
    {
        $this->artifacts->exchangeArray($artifacts);

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.ArtifactDownloaderTaskProperties';
    }
}
