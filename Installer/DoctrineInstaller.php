<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DoctrineInstaller implements InstallerInterface
{
    /** @var string */
    private $composerPath;

    /** @var array */
    private $bundles;

    public function __construct($composerPath, $bundles)
    {
        $this->composerPath = $composerPath;
        $this->bundles = $bundles;
    }

    public function install()
    {
        if (!\file_exists($this->composerPath)) {
            throw new \Exception(\sprintf("Composer not found at path : %s", $this->composerPath));
        }

        if (!\is_executable($this->composerPath)) {
            throw new \Exception(\sprintf("The %s file is not executable", $this->composerPath));
        }

        $bundleInfo = AvailableBundles::BUNDLES['DoctrineBundle'];

        $packages = $bundleInfo['composer'];
        $command = \array_merge([$this->composerPath, 'require'], $packages);

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function isInstalled()
    {
        return \array_key_exists('DoctrineBundle', \array_keys($this->bundles));
    }
}