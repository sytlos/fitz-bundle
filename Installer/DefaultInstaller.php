<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class DefaultInstaller extends AbstractInstaller
{
    /**
     * @throws \Exception
     */
    public function install()
    {
        if (!\file_exists($this->getComposerPath())) {
            throw new \Exception(\sprintf("Composer not found at path : %s", $this->getComposerPath()));
        }

        if (!\is_executable($this->getComposerPath())) {
            throw new \Exception(\sprintf("The %s file is not executable", $this->getComposerPath()));
        }

        $bundleInfo = AvailableBundles::BUNDLES[$this->getBundleName()];

        $packages = $bundleInfo['composer'];
        $command = \array_merge([$this->getComposerPath(), 'require'], $packages);

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->unqueue();
    }
}