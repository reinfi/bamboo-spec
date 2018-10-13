<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @package Reinfi\BambooSpec\Exception
 */
class ValidationException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $errors;

    /**
     * @param $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
