<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Model\AvailableBundles;

abstract class AbstractInstaller implements InstallerInterface
{
    /** @var string */
    private $composerPath;

    /** @var array */
    private $bundles;

    /** @var string */
    private $projectDir;

    /** @var string */
    private $queueFilePath;

    /** @var string */
    private $bundleName;

    /**
     * DefaultInstaller constructor.
     * @param string $composerPath
     * @param array $bundles
     * @param string $projectDir
     * @param string $queueFilePath
     */
    public function __construct($composerPath, $bundles, $projectDir, $queueFilePath)
    {
        $this->composerPath = $composerPath;
        $this->bundles = $bundles;
        $this->projectDir = $projectDir;
        $this->queueFilePath = $queueFilePath;
    }

    /**
     * @return bool
     */
    public function isInstalled()
    {
        return \in_array($this->getBundleName(), \array_keys($this->bundles));
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isQueued()
    {
        return \file_exists($this->getQueueFilepath()) && FileHelper::contains($this->getQueueFilepath(), $this->getBundleName());
    }

    public function queue()
    {
        FileHelper::append($this->getQueueFilepath(), \sprintf('%s;', $this->getBundleName()));
    }

    /**
     * @throws \Exception
     */
    public function unqueue()
    {
        FileHelper::remove($this->getQueueFilepath(), \sprintf('%s;', $this->getBundleName()));
    }

    /**
     * @return null|string
     */
    public function getBundleName(): ?string
    {
        return $this->bundleName;
    }

    /**
     * @param string $bundleName
     */
    public function setBundleName(string $bundleName): void
    {
        $this->bundleName = $bundleName;
    }

    /**
     * @return string
     */
    public function getQueueFilepath()
    {
        return \sprintf('%s/%s', $this->queueFilePath, AvailableBundles::QUEUE_FILE);
    }

    /**
     * @return string
     */
    public function getComposerPath(): string
    {
        return $this->composerPath;
    }

    /**
     * @return string
     */
    public function getProjectDir(): string
    {
        return $this->projectDir;
    }
}