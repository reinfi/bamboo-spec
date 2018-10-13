<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Interfaces;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Builder\Interfaces
 */
interface TypedInterface
{
    /**
     * @Assert\NotBlank()
     *
     * Matching class of bamboo java spec.
     *
     * @return string
     */
    public function getJavaClass(): string;
}
