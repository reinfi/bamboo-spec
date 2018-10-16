<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Plan\Branch;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Plan\Branch
 */
class CreatePlanBranches
{
    public const TRIGGER_MANUAL = 'MANUAL';
    public const TRIGGER_PULL_REQUEST = 'PULL_REQUEST';
    public const TRIGGER_BRANCH = 'BRANCH';

    /**
     * @Assert\Choice({"MANUAL", "PULL_REQUEST", "BRANCH"})
     *
     * @var string
     */
    private $trigger = self::TRIGGER_MANUAL;

    /**
     * @var string
     */
    private $matchingPattern;

    /**
     * @param string $trigger
     * @param string $matchingPattern
     */
    public function __construct(
        string $trigger = self::TRIGGER_MANUAL,
        string $matchingPattern = null
    ) {
        $this->trigger = $trigger;
        $this->matchingPattern = $matchingPattern;
    }
}
