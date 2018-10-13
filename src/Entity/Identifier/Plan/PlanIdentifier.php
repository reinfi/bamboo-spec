<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Identifier\Plan;

use Reinfi\BambooSpec\Entity\BambooKey;
use Reinfi\BambooSpec\Entity\BambooOid;
use Reinfi\BambooSpec\Entity\Plan;
use Reinfi\BambooSpec\Entity\Project;

/**
 * @package Reinfi\BambooSpec\Entity\Identifier\Plan
 */
class PlanIdentifier extends AbstractPlanIdentifier
{
    /**
     * @var BambooKey
     */
    private $projectKey;

    /**
     * @param null|BambooKey $projectKey
     * @param null|BambooKey $key
     * @param null|BambooOid $oid
     */
    protected function __construct(
        ?BambooKey $projectKey,
        ?BambooKey $key,
        ?BambooOid $oid = null
    ) {
        parent::__construct($key, $oid);

        $this->projectKey = $projectKey;
    }

    public static function fromPlan(Plan $plan): PlanIdentifier
    {
        return new PlanIdentifier(
            $plan->getProject()->getKey(),
            $plan->getKey(),
            $plan->getOid()
        );
    }

    public static function fromProjectAndKey(
        Project $project,
        BambooKey $key
    ): PlanIdentifier {
        return new PlanIdentifier(
            $project->getKey(),
            $key
        );
    }

    public static function fromOid(
        BambooOid $oid
    ): PlanIdentifier {
        return new PlanIdentifier(
            null,
            null,
            $oid
        );
    }
}
