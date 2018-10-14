<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Job\Docker;

use JMS\Serializer\Annotation as Serializer;
use PhpCollection\Map;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @package Reinfi\BambooSpec\Entity\Job\Docker
 *
 * @Serializer\ExclusionPolicy("none")
 */
class DockerConfiguration
{
    private const DEFAULT_VOLUMES = [
        '${bamboo.working.directory}' => '${bamboo.working.directory}',
        '${bamboo.tmp.directory}' => '${bamboo.tmp.directory}',
    ];

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $image;

    /**
     * @Serializer\Exclude()
     *
     * @var bool
     */
    private $defaultVolumes;

    /**
     * @Assert\Valid()
     *
     * @var Map
     */
    private $volumes;

    /**
     * @param bool $enabled
     */
    public function __construct(bool $enabled = true)
    {
        $this->enabled = $enabled;
        $this->defaultVolumes = true;
        $this->volumes = new Map();
    }

    /**
     * Specify the name of the Docker image to use.
     *
     * You can define the repository host, namespace and tag for the image,
     * by following the Docker image format
     * (e.g. {@code localhost:5000/namespace/image:tag}).
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @param string $image
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return DockerConfiguration
     */
    public function withoutDefaultVolumes(): self
    {
        $this->defaultVolumes = false;

        return $this;
    }

    /**
     * Add a volume to the Docker configuration.
     *
     * Please note that some volumes are mounted by default.
     * To get rid of default volume mappings, call withoutDefaultVolumes().
     *
     * @param string $hostDirectory
     * @param string $containerDirectory
     *
     * @return DockerConfiguration
     */
    public function addVolume(string $hostDirectory, string $containerDirectory): self
    {
        if ($this->volumes->containsKey($hostDirectory)) {
            throw new \InvalidArgumentException('Host directory ' . $hostDirectory . ' is used by more than one volume.');
        }

        $this->volumes->set($hostDirectory, $containerDirectory);

        return $this;
    }

    /**
     * @Serializer\PreSerialize()
     */
    protected function preSerialize(): void
    {
        if ($this->enabled && $this->defaultVolumes) {
            $this->volumes->setAll(self::DEFAULT_VOLUMES);
        }
    }

    /**
     * @Assert\Callback()
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        foreach ($this->volumes as $hostDirectory => $containerDirectory) {
            if (empty($hostDirectory)) {
                $context
                    ->buildViolation('Host directory should not be empty for docker volume')
                    ->atPath('volumes')
                    ->addViolation();
            }

            if (empty($containerDirectory)) {
                $context
                    ->buildViolation('Container directory should not be empty for docker volume')
                    ->atPath('volumes')
                    ->atPath($hostDirectory)
                    ->addViolation();
            }
        }
    }
}
