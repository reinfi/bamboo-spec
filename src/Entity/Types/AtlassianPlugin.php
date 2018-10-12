<?php

namespace Reinfi\BambooSpec\Entity\Types;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class AtlassianPlugin
{
    /**
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
