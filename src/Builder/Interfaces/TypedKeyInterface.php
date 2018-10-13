<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Builder\Interfaces;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Builder\Interfaces
 */
interface TypedKeyInterface extends TypedInterface
{
    /**
     * @Assert\NotBlank()
     *
     * @return string
     */
    public function getTypeKey(): string;
}
