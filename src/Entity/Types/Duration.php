<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Types;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class Duration
{
    /**
     * @var int
     */
    private $seconds;

    /**
     * @param int $seconds
     */
    private function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    /**
     * @param int $minutes
     *
     * @return Duration
     */
    public static function durationInMinutes(int $minutes): Duration
    {
        return new Duration($minutes * 60);
    }

    /**
     * @param int $seconds
     *
     * @return Duration
     */
    public static function durationInSeconds(int $seconds): Duration
    {
        return new Duration($seconds);
    }

    /**
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->seconds;
    }
}
