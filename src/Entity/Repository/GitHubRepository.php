<?php

namespace Reinfi\BambooSpec\Entity\Repository;

use JMS\Serializer\Annotation as Serializer;
use Reinfi\BambooSpec\Entity\Authentication\AuthenticationInterface;
use Reinfi\BambooSpec\Entity\Types\Duration;

/**
 * @package Reinfi\BambooSpec\Entity\Repository
 */
class GitHubRepository extends AbstractRepository
{
    /** @var string */
    private $repository;

    /** @var string */
    private $branch;

    /**
     * @Serializer\SerializedName("authenticationProperties")
     *
     * @var AuthenticationInterface
     */
    private $authentication;

    /** @var bool */
    private $useShallowClones;

    /** @var bool */
    private $useRemoteAgentCache = true;

    /** @var bool */
    private $useSubmodules;

    /** @var Duration */
    private $commandTimeout;

    /** @var bool */
    private $verboseLogs;

    /** @var bool */
    private $fetchWholeRepository;

    /** @var bool */
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
     * @param string $repository
     *
     * @return GitHubRepository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * @param string $branch
     *
     * @return GitHubRepository
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @param AuthenticationInterface $authentication
     *
     * @return GitHubRepository
     */
    public function setAuthentication(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * @param bool $useShallowClones
     *
     * @return GitHubRepository
     */
    public function setUseShallowClones($useShallowClones)
    {
        $this->useShallowClones = $useShallowClones;

        return $this;
    }

    /**
     * @param bool $useRemoteAgentCache
     *
     * @return GitHubRepository
     */
    public function setUseRemoteAgentCache($useRemoteAgentCache)
    {
        $this->useRemoteAgentCache = $useRemoteAgentCache;

        return $this;
    }

    /**
     * @param bool $useSubmodules
     *
     * @return GitHubRepository
     */
    public function setUseSubmodules($useSubmodules)
    {
        $this->useSubmodules = $useSubmodules;

        return $this;
    }

    /**
     * @param int $commandTimeoutInMinutes
     *
     * @return GitHubRepository
     */
    public function setCommandTimeout(int $commandTimeoutInMinutes)
    {
        $this->commandTimeout = Duration::durationInMinutes($commandTimeoutInMinutes);

        return $this;
    }

    /**
     * @param bool $verboseLogs
     *
     * @return GitHubRepository
     */
    public function setVerboseLogs($verboseLogs)
    {
        $this->verboseLogs = $verboseLogs;

        return $this;
    }

    /**
     * @param bool $fetchWholeRepository
     *
     * @return GitHubRepository
     */
    public function setFetchWholeRepository($fetchWholeRepository)
    {
        $this->fetchWholeRepository = $fetchWholeRepository;

        return $this;
    }

    /**
     * @param bool $useLfs
     *
     * @return GitHubRepository
     */
    public function setUseLfs($useLfs)
    {
        $this->useLfs = $useLfs;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.repository.github.GitHubRepositoryProperties';
    }
}
