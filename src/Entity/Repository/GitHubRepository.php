<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Repository;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Authentication\AuthenticationInterface;
use Reinfi\BambooSpec\Entity\Types\Duration;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Reinfi\BambooSpec\Entity\Repository
 */
class GitHubRepository extends AbstractRepository
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $repository;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $branch;

    /**
     * @Assert\NotNull()
     *
     * @Serializer\SerializedName("authenticationProperties")
     *
     * @var AuthenticationInterface
     */
    private $authentication;

    /**
     * @var bool
     */
    private $useShallowClones;

    /**
     * @var bool
     */
    private $useRemoteAgentCache = true;

    /**
     * @var bool
     */
    private $useSubmodules;

    /**
     * @var Duration
     */
    private $commandTimeout;

    /**
     * @var bool
     */
    private $verboseLogs;

    /**
     * @var bool
     */
    private $fetchWholeRepository;

    /**
     * @var bool
     */
    private $useLfs;

    public function __construct(
        string $name,
        string $repository,
        string $branch,
        AuthenticationInterface $authentication
    ) {
        parent::__construct($name);

        $this->repository = $repository;
        $this->branch = $branch;
        $this->authentication = $authentication;
        $this->commandTimeout = Duration::durationInMinutes(180);
    }

    /**
     * @param bool $useShallowClones
     *
     * @return GitHubRepository
     */
    public function setUseShallowClones(bool $useShallowClones): self
    {
        $this->useShallowClones = $useShallowClones;

        return $this;
    }

    /**
     * @param bool $useRemoteAgentCache
     *
     * @return GitHubRepository
     */
    public function setUseRemoteAgentCache(bool $useRemoteAgentCache): self
    {
        $this->useRemoteAgentCache = $useRemoteAgentCache;

        return $this;
    }

    /**
     * @param bool $useSubmodules
     *
     * @return GitHubRepository
     */
    public function setUseSubmodules(bool $useSubmodules): self
    {
        $this->useSubmodules = $useSubmodules;

        return $this;
    }

    /**
     * @param int $commandTimeoutInMinutes
     *
     * @return GitHubRepository
     */
    public function setCommandTimeout(int $commandTimeoutInMinutes): self
    {
        $this->commandTimeout = Duration::durationInMinutes($commandTimeoutInMinutes);

        return $this;
    }

    /**
     * @param bool $verboseLogs
     *
     * @return GitHubRepository
     */
    public function setVerboseLogs(bool $verboseLogs): self
    {
        $this->verboseLogs = $verboseLogs;

        return $this;
    }

    /**
     * @param bool $fetchWholeRepository
     *
     * @return GitHubRepository
     */
    public function setFetchWholeRepository(bool $fetchWholeRepository): self
    {
        $this->fetchWholeRepository = $fetchWholeRepository;

        return $this;
    }

    /**
     * @param bool $useLfs
     *
     * @return GitHubRepository
     */
    public function setUseLfs(bool $useLfs): self
    {
        $this->useLfs = $useLfs;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.repository.github.GitHubRepositoryProperties';
    }
}
