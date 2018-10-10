<?php

namespace Reinfi\BambooSpec\Entity\Types;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class MultiLine
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
