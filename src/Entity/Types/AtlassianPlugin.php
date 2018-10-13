<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Types;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class AtlassianPlugin
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $completeModuleKey;

    /**
     * @param string $completeModuleKey
     */
    public function __construct(string $completeModuleKey)
    {
        $this->completeModuleKey = $completeModuleKey;
    }
}
