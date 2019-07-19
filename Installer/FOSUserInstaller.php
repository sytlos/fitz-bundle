<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class FOSUserInstaller implements InstallerInterface
{
    /** @var string */
    private $composerPath;

    /** @var array */
    private $bundles;

    /** @var string */
    private $projectDir;

    /** @var string */
    private $bundleName;

    public function __construct($composerPath, $bundles, $projectDir)
    {
        $this->composerPath = $composerPath;
        $this->bundles = $bundles;
        $this->projectDir = $projectDir;
    }

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

        $this->configure();
        $this->unqueue();
    }

    public function configure()
    {
        $configFile = \sprintf('%s/config/packages/fos_user.yaml', $this->projectDir);

        if (!\file_exists($configFile)) {
            $defaultConfigFile = \sprintf('%s/../Resources/default_config/fos_user.yaml', __DIR__);
            FileHelper::copy($defaultConfigFile, $configFile);
        }

        $frameworkFile = \sprintf('%s/config/packages/framework.yaml', $this->projectDir);
        if (\file_exists($frameworkFile) && !FileHelper::contains($frameworkFile, 'templating')) {
            $templatingConfig = \file_get_contents(\sprintf('%s/../Resources/default_config/framework.yaml', __DIR__));
            FileHelper::append($frameworkFile, $templatingConfig);
        }
    }

    public function isInstalled()
    {
        return \array_key_exists($this->getBundleName(), \array_keys($this->bundles));
    }

    public function isQueued()
    {
        return \file_exists($this->getQueueFilepath()) && FileHelper::contains($this->getQueueFilepath(), $this->getBundleName());
    }

    public function queue()
    {
        FileHelper::append($this->getQueueFilepath(), \sprintf('%s;', $this->getBundleName()));
    }

    public function unqueue()
    {
        FileHelper::remove($this->getQueueFilepath(), \sprintf('%s;', $this->getBundleName()));
    }

    public function getBundleName(): ?string
    {
        return $this->bundleName;
    }

    public function setBundleName(string $bundleName): void
    {
        $this->bundleName = $bundleName;
    }

    public function getQueueFilepath()
    {
        return \sprintf('%s/%s', $this->projectDir, AvailableBundles::QUEUE_FILE);
    }
}