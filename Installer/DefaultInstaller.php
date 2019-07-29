<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class DefaultInstaller implements InstallerInterface
{
    /** @var string */
    private $composerPath;

    /** @var array */
    private $bundles;

    /** @var string */
    private $projectDir;

    /** @var string */
    private $bundleName;

    /**
     * DefaultInstaller constructor.
     * @param string $composerPath
     * @param array $bundles
     * @param string $projectDir
     */
    public function __construct($composerPath, $bundles, $projectDir)
    {
        $this->composerPath = $composerPath;
        $this->bundles = $bundles;
        $this->projectDir = $projectDir;
    }

    /**
     * @throws \Exception
     */
    public function install()
    {
        if (!\file_exists($this->composerPath)) {
            throw new \Exception(\sprintf("Composer not found at path : %s", $this->composerPath));
        }

        if (!\is_executable($this->composerPath)) {
            throw new \Exception(\sprintf("The %s file is not executable", $this->composerPath));
        }

        $bundleInfo = AvailableBundles::BUNDLES[$this->getBundleName()];

        $packages = $bundleInfo['composer'];
        $command = \array_merge([$this->composerPath, 'require'], $packages);

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->unqueue();
    }

    public function configure()
    {
        return;
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
        return \sprintf('%s/vendor/hugosoltys/fitz-bundle/%s', $this->projectDir, AvailableBundles::QUEUE_FILE);
    }
}