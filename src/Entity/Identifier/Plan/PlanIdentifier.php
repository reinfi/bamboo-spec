<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Identifier\Plan;

use Reinfi\BambooSpec\Entity\BambooKey;
use Reinfi\BambooSpec\Entity\BambooOid;
use Reinfi\BambooSpec\Entity\Plan;
use Reinfi\BambooSpec\Entity\Project;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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

    /**
     * @Assert\Callback()
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->oid === null && $this->projectKey === null && $this->key === null) {
            $context
                ->buildViolation('Either full key and project key or oid need to be defined when referencing plan')
                ->addViolation();
        }
    }
}
