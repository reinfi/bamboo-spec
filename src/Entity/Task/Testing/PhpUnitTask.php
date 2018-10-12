<?php

namespace Reinfi\BambooSpec\Entity\Task\Testing;

use Reinfi\BambooSpec\Entity\Task\AnyTask;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Testing
 */
class PhpUnitTask extends AnyTask
{
    /** @var string */
    private $label;

    /** @var string */
    private $arguments;

    /** @var string */
    private $environmentVariables;

    /** @var string */
    private $workingSubDirectory;

    /** @var bool */
    private $logXmlEnabled;

    /** @var string */
    private $logXmlFile;

    /** @var bool */
    private $coverageHtmlEnabled;

    /** @var string */
    private $coverageHtmlDirectory;

    /** @var bool */
    private $pickupOutdatedFiles;

    /**
     * @param string $executableLabel
     * @param string $arguments
     */
    public function __construct(string $executableLabel, string $arguments)
    {
        $this->label = $executableLabel;
        $this->arguments = $arguments;
    }

    /**
     * @param string $resultFile
     *
     * @return PhpUnitTask
     */
    public function enableResultLog(
        string $resultFile = 'test-reports/phpunit.xml'
    ): self {
        $this->logXmlEnabled = true;
        $this->logXmlFile = $resultFile;

        return $this;
    }

    /**
     * @param string $coverageDirectory
     *
     * @return PhpUnitTask
     */
    public function enableHtmlTestCoverage(
        string $coverageDirectory = 'test-reports/coverage/html'
    ): self {
        $this->coverageHtmlEnabled = true;
        $this->coverageHtmlDirectory = $coverageDirectory;

        return $this;
    }

    /**
     * @param string $environmentVariables
     *
     * @return self
     */
    public function setEnvironmentVariables(string $environmentVariables): self
    {
        $this->environmentVariables = $environmentVariables;

        return $this;
    }

    /**
     * @param string $workingSubDirectory
     *
     * @return self
     */
    public function setWorkingSubDirectory(string $workingSubDirectory): self
    {
        $this->workingSubDirectory = $workingSubDirectory;

        return $this;
    }

    /**
     * @param bool $pickupOutdatedFiles
     *
     * @return self
     */
    public function setPickupOutdatedFiles($pickupOutdatedFiles): self
    {
        $this->pickupOutdatedFiles = $pickupOutdatedFiles;

        return $this;
    }

    protected function getTaskClass(): string
    {
        return 'com.atlassian.bamboo.plugins.php:task.builder.phpunit';
    }
}
