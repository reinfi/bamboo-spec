<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Requirement;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Requirement
 */
class Requirement
{
    public const MATCH_TYPE_EXISTS = 'EXISTS';
    public const MATCH_TYPE_EQUALS = 'EQUALS';
    public const MATCH_TYPE_MATCHES = 'MATCHES';

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $key;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Choice({"EXISTS", "EQUALS", "MATCHES"})
     *
     * @var string
     */
    private $matchType = self::MATCH_TYPE_EXISTS;

    /**
     * @var string
     */
    private $matchValue = ".*";

    /**
     * @param string      $key
     * @param string      $matchType
     * @param string|null $matchValue
     */
    protected function __construct(
        string $key,
        string $matchType,
        string $matchValue = null
    ) {
        $this->key = $key;
        $this->matchValue = $matchValue;
        $this->matchType = $matchType;
    }

    /**
     * Specifies a requirement that a capability with matching key exists.
     *
     * @param string $key
     *
     * @return Requirement
     */
    public static function exists(string $key): self
    {
        return new Requirement($key, self::MATCH_TYPE_EXISTS);
    }

    /**
     * Specifies a requirement that a capability with matching key has value
     * equal to value of requirement.
     *
     * @param string $key
     * @param string $value
     *
     * @return Requirement
     */
    public static function equals(string $key, string $value): self
    {
        return new Requirement($key, self::MATCH_TYPE_EQUALS, $value);
    }

    /**
     * Specifies a requirement that a capability with matching key has value
     * that matches regexp provided in value of requirement.
     *
     * @param string $key
     * @param string $value
     *
     * @return Requirement
     */
    public static function matches(string $key, string $value): self
    {
        return new Requirement($key, self::MATCH_TYPE_MATCHES, $value);
    }
}
