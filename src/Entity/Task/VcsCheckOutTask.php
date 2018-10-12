<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Task;

use Reinfi\BambooSpec\Entity\Vcs\CheckOutItem;
use Reinfi\BambooSpec\Entity\Vcs\VcsRepositoryIdentifier;

/**
 * @package Reinfi\BambooSpec\Entity\Task
 */
class VcsCheckOutTask extends AbstractTask
{
    /** @var \ArrayObject */
    private $checkoutItems;

    /** @var bool */
    private $cleanCheckout;

    public function __construct()
    {
        $this->checkoutItems = new \ArrayObject();
    }

    /**
     * Adds checkout request for the plan's default repository into the build directory.
     * Default repository is the repository which is the first on the list of plan's repositories.
     *
     * The repository will be checked out to the build's working directory. For more control
     * over checkout path, use @see withCheckoutItems.
     *
     * @return VcsCheckOutTask
     */
    public function addCheckoutOfDefaultRepository(): self
    {
        $this->checkoutItems->append(
            (new CheckOutItem())->useDefaultRepository()
        );

        return $this;
    }

    /**
     * Adds checkout request for one of plan's repositories into the build directory.
     *
     * The repository will be checked out to the build's working directory. For more control
     * over checkout path, use @see withCheckoutItems.
     *
     * @param VcsRepositoryIdentifier $repository
     *
     * @return VcsCheckOutTask
     */
    public function addCheckoutOfRepository(VcsRepositoryIdentifier $repository): self
    {
        $this->checkoutItems->append(
            (new CheckOutItem())->setRepository($repository)
        );

        return $this;
    }

    /**
     * Adds checkout requests.
     *
     * @param CheckOutItem ...$checkoutItems
     *
     * @return VcsCheckOutTask
     */
    public function withCheckoutItems(CheckOutItem ...$checkoutItems): self
    {
        $this->checkoutItems->exchangeArray($checkoutItems);

        return $this;
    }

    /**
     * Enables/disabled clean checkout. If set, the task cleans the content of
     * the checkout target directory before checking out the source. Off by default.
     *
     * @param bool $cleanCheckout
     *
     * @return self
     */
    public function setCleanCheckout(bool $cleanCheckout): self
    {
        $this->cleanCheckout = $cleanCheckout;

        return $this;
    }

    public function getJavaClass(): string
    {
        return 'com.atlassian.bamboo.specs.model.task.VcsCheckoutTaskProperties';
    }
}
