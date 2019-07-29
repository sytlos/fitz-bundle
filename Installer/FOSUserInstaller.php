<?php

namespace HugoSoltys\FitzBundle\Installer;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class FOSUserInstaller extends AbstractInstaller
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

        $this->configure();
        $this->unqueue();
    }

    /**
     * @throws \Exception
     */
    public function configure()
    {
        $configFile = \sprintf('%s/config/packages/fos_user.yaml', $this->getProjectDir());

        if (!\file_exists($configFile)) {
            $defaultConfigFile = \sprintf('%s/../Resources/default_config/fos_user.yaml', __DIR__);
            FileHelper::copy($defaultConfigFile, $configFile);
        }

        $frameworkFile = \sprintf('%s/config/packages/framework.yaml', $this->getProjectDir());
        if (\file_exists($frameworkFile) && !FileHelper::contains($frameworkFile, 'templating')) {
            $templatingConfig = \file_get_contents(\sprintf('%s/../Resources/default_config/framework.yaml', __DIR__));
            FileHelper::append($frameworkFile, $templatingConfig);
        }
    }
}