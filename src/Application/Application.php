<?php

namespace Reinfi\BambooSpec\Application;

use Reinfi\BambooSpec\Command\PublishCommand;

/**
 * @package Reinfi\BambooSpec\Application
 */
class Application extends \Symfony\Component\Console\Application
{
    public function __construct()
    {
        parent::__construct('Bamboo Spec', '1.0');
    }

    protected function getDefaultCommands(): array
    {
        return array_merge(
            parent::getDefaultCommands(),
            [
                new PublishCommand(),
            ]
        );
    }
}
