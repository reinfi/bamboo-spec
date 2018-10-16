<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Types;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 *
 * @internal
 */
class NotificationApplicableTo
{
    /**
     * @Assert\Choice({"PLANS"})
     *
     * @var string
     */
    private $applicableTo;

    /**
     * @param string $applicableTo
     */
    public function __construct(string $applicableTo)
    {
        $this->applicableTo = $applicableTo;
    }

    /**
     * @return string
     */
    public function getApplicableTo(): string
    {
        return $this->applicableTo;
    }
}
