<?php

namespace HugoSoltys\FitzBundle\Installer;

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

    const BUNDLE_NAME = 'FOSUserBundle';

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

        $bundleInfo = AvailableBundles::BUNDLES[self::BUNDLE_NAME];

        $packages = $bundleInfo['composer'];
        $command = \array_merge([$this->composerPath, 'require'], $packages);

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->configure();
        $this->cacheClear();
        $this->unqueue();
    }

    public function configure()
    {
        $configFile = \sprintf('%s/config/packages/fos_user.yaml', $this->projectDir);

        if (!\file_exists($configFile)) {
            $defaultConfigFile = \sprintf('%s/../Resources/default_config/fos_user.yaml', __DIR__);
            \copy($defaultConfigFile, $configFile);
        }
    }

    public function isInstalled()
    {
        return \array_key_exists(self::BUNDLE_NAME, \array_keys($this->bundles));
    }

    public function cacheClear()
    {
        $console = \sprintf('%s/bin/console', $this->projectDir);
        $process = new Process([$console, 'cache:clear']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function isQueued()
    {
        return \file_exists(AvailableBundles::QUEUE_FILE) && \strpos(\file_get_contents(AvailableBundles::QUEUE_FILE), self::BUNDLE_NAME) !== false;
    }

    public function queue()
    {
        \file_put_contents(AvailableBundles::QUEUE_FILE, \sprintf('%s;', self::BUNDLE_NAME), FILE_APPEND | LOCK_EX);
    }

    public function unqueue()
    {
        $content = \file_get_contents(AvailableBundles::QUEUE_FILE);
        $content = \str_replace(\sprintf('%s;', self::BUNDLE_NAME), '', $content);
        \file_put_contents(AvailableBundles::QUEUE_FILE, $content);
    }
}