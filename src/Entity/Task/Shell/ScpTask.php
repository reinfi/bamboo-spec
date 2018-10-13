<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task\Shell;

use Reinfi\BambooSpec\Entity\Artifact\ArtifactItem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Task\Shell
 */
class ScpTask extends AbstractSshTask
{
    /**
     * @var bool
     */
    private $localPathAntStyle = false;

    /**
     * @var string
     */
    private $localPath;

    /**
     * @var ArtifactItem
     */
    private $artifactItem;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $remotePath;

    /**
     * The local path (relative to the Bamboo working directory) to the files you want to copy.
     * Use commas to separate files and directories.
     * You can also use Ant-style pattern matching to include multiple files, such as **\/target/*.jar.
     * Ant-style pattern matching is false by default.
     *
     * @param string $localPath
     * @param bool   $isAntPathStyle
     *
     * @return ScpTask
     */
    public function setLocalPath(
        string $localPath,
        bool $isAntPathStyle = false
    ): self {
        $this->localPathAntStyle = $isAntPathStyle;
        $this->localPath = $localPath;

        return $this;
    }

    /**
     * @param ArtifactItem $artifactItem
     *
     * @return self
     */
    public function setArtifactItem(ArtifactItem $artifactItem): self
    {
        $this->artifactItem = $artifactItem;

        return $this;
    }

    /**
     * The path to the destination directory on the remote server.
     *
     * @param string $remotePath
     *
     * @return ScpTask
     */
    public function setRemotePath(string $remotePath): self
    {
        $this->remotePath = $remotePath;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.ScpTaskProperties';
    }
}
