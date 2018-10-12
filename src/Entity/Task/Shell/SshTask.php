<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Shell;

use Reinfi\BambooSpec\Entity\Types\Duration;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Shell
 */
class SshTask extends AbstractSshTask
{
    /** @var string */
    private $command;

    /** @var Duration */
    private $keepAliveInterval;

    /**
     * Shell command to execute on the remote host.
     *
     * @param string $command
     *
     * @return self
     */
    public function setCommand(string $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @param string $filePath
     *
     * @return SshTask
     */
    public function setCommandFromFile(string $filePath): self
    {
        $this->setCommand(file_get_contents($filePath));

        return $this;
    }

    /**
     * Sets the SSH keep alive interval in seconds.
     *
     * @param int $seconds
     *
     * @return SshTask
     */
    public function withKeepAliveInternalInSeconds(int $seconds): self
    {
        $this->keepAliveInterval = Duration::durationInSeconds($seconds);

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.SshTaskProperties';
    }
}
