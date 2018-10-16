<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Types;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class Duration
{
    private const SECONDS_PER_DAY = 60 * 60 * 24;

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
     * @return Duration
     */
    public static function durationZero(): Duration
    {
        return new Duration(0);
    }

    /**
     * @param int $days
     *
     * @return Duration
     */
    public static function durationInDays(int $days): Duration
    {
        return new Duration($days * self::SECONDS_PER_DAY);
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
