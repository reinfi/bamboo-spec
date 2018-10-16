<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Identifier\Plan;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @package Reinfi\BambooSpec\Entity\Identifier\Plan
 */
class PlanBranchIdentifier extends AbstractPlanIdentifier
{
    /**
     * @Assert\Callback()
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->oid === null && $this->key === null) {
            $context
                ->buildViolation('Either key or oid need to be defined when referencing plan')
                ->addViolation();
        }
    }
}
