<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Testing;

use PhpCollection\Sequence;
use PhpCollection\SequenceInterface;
use Reinfi\BambooSpec\Entity\Task\AbstractTask;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Testing
 */
class TestParserTask extends AbstractTask
{
    private const TEST_TYPE_JUNIT = 'JUNIT';
    private const TEST_TYPE_TESTNG = 'TESTING';
    private const TEST_TYPE_NUNIT = 'NUNIT';
    private const TEST_TYPE_MOCHA = 'MOCHA';

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Choice({"JUNIT", "TESTING", "NUNIT", "MOCHA"})
     *
     * @var string
     */
    private $testType;

    /**
     * @Assert\All({
     *     @Assert\NotBlank
     * })
     *
     * @var SequenceInterface
     */
    private $resultDirectories;

    /**
     * @var bool
     */
    private $pickUpTestResultsCreatedOutsideOfThisBuild;

    /**
     * @param string $testType
     */
    public function __construct(string $testType)
    {
        $this->testType = $testType;

        $this->resultDirectories = new Sequence();
    }

    /**
     * Specify test parsing task that handles JUnit test results.
     */
    public static function createJUnitParserTask()
    {
        return new TestParserTask(self::TEST_TYPE_JUNIT);
    }

    /**
     * Specify test parsing task that handles TestNG test results.
     */
    public static function createTestNGParserTask()
    {
        return new TestParserTask(self::TEST_TYPE_TESTNG);
    }

    /**
     * Specify test parsing task that handles NUnit test results.
     */
    public static function createNUnitParserTask()
    {
        return new TestParserTask(self::TEST_TYPE_NUNIT);
    }

    /**
     * Specify test parsing task that handles test results of Mocha executed with 'mocha-bamboo-reporter'.
     */
    public static function createMochaParserTask()
    {
        return new TestParserTask(self::TEST_TYPE_MOCHA);
    }

    /**
     * Adds directories from the argument to the list of directories in which task looks for
     * test result files.
     *
     * @param string $resultDirectory
     *
     * @return TestParserTask
     */
    public function addResultDirectory(string $resultDirectory): self
    {
        $this->resultDirectories->add($resultDirectory);

        return $this;
    }

    /**
     * Replaces directories from the argument in the list of directories in which
     * task looks for test result files.
     *
     * @param string ...$resultDirectories
     *
     * @return TestParserTask
     */
    public function withResultDirectories(string ...$resultDirectories): self
    {
        $this->resultDirectories->addAll($resultDirectories);

        return $this;
    }

    /**
     * Adds default directory to the list of directories in which task looks for test result files.
     * Default directory is defined depending on the selected test engine.
     */
    public function useDefaultResultDirectory()
    {
        switch ($this->testType) {
            case self::TEST_TYPE_JUNIT:
                return $this->addResultDirectory("**/test-reports/*.xml");
            case self::TEST_TYPE_NUNIT:
                return $this->addResultDirectory("**/test-reports/*.xml");
            case self::TEST_TYPE_TESTNG:
                return $this->addResultDirectory("**/testng-results.xml");
            case self::TEST_TYPE_MOCHA:
                return $this->addResultDirectory("mocha.json");
            default:
                throw new \InvalidArgumentException(
                    "Unsupported test type: " . $this->testType
                );
        }
    }

    /**
     * Allows/disallows the task to scan test result files created before start time of the build.
     *
     * @param bool $pickUpTestResultsCreatedOutsideOfThisBuild
     *
     * @return self
     */
    public function setPickUpTestResultsCreatedOutsideOfThisBuild(
        bool $pickUpTestResultsCreatedOutsideOfThisBuild
    ): self {
        $this->pickUpTestResultsCreatedOutsideOfThisBuild = $pickUpTestResultsCreatedOutsideOfThisBuild;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.TestParserTaskProperties';
    }
}
