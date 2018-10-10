<?php

namespace Reinfi\BambooSpec\Config;

/**
 * @package Reinfi\BambooSpec\Config
 */
trait WithConfig
{
    /**
     * @var Config
     */
    private $config;

    public function withConfig(Config $config): self
    {
        $this->config = $config;

        return $this;
    }
}
