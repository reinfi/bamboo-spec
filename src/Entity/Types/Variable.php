<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Types;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Types
 */
class Variable
{
    /**
     * Variables with names containing words like 'password', 'secret', 'passwd'
     * are considered 'secret' and are encrypted.
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * In case of 'secret' variables, both encrypted and unencrypted form is valid.
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $value;

    /**
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }


}
