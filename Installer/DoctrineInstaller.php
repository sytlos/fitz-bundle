<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DoctrineInstaller implements InstallerInterface
{
    public function install()
    {
        $bundleInfo = AvailableBundles::BUNDLES['DoctrineBundle'];

        $package = $bundleInfo['composer'];

        $process = new Process(['/usr/local/bin/composer', 'require', $package]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}