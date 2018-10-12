<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * @package Reinfi\BambooSpec\Config
 */
class ConfigParser
{
    public function parse(string $filePath): Config
    {
        $config = Yaml::parseFile($filePath);

        return new Config(
            $config['entry'],
            $config['server'],
            $config['credentials'] ?? null
        );
    }
}
