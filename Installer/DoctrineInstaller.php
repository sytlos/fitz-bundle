<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DoctrineInstaller implements InstallerInterface
{
    /** @var string */
    private $composerPath;

    public function __construct($composerPath)
    {
        $this->composerPath = $composerPath;
    }

    public function install()
    {
        $bundleInfo = AvailableBundles::BUNDLES['DoctrineBundle'];

        $package = $bundleInfo['composer'];

        $process = new Process([$this->composerPath, 'require', $package]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}