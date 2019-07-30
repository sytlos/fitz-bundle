<?php

namespace HugoSoltys\FitzBundle\Command;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Installer\AbstractInstaller;
use HugoSoltys\FitzBundle\Installer\DefaultInstaller;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class InstallBundlesCommand extends Command
{
    protected static $defaultName = 'fitz:install';

    /** @var string */
    private $composerPath;

    /** @var array */
    private $bundles;

    /** @var string */
    private $projectDir;

    /** @var string */
    private $queueFilePath;

    /**
     * InstallBundlesCommand constructor.
     * @param null|string $name
     * @param $composerPath
     * @param $bundles
     * @param $projectDir
     * @param $queueFilePath
     */
    public function __construct(?string $name = null, $composerPath, $bundles, $projectDir, $queueFilePath)
    {
        parent::__construct($name);
        $this->composerPath = $composerPath;
        $this->bundles = $bundles;
        $this->projectDir = $projectDir;
        $this->queueFilePath = $queueFilePath;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        ini_set('memory_limit', -1);

        $io = new SymfonyStyle($input, $output);
        $io->title('FitzBundle install command');

        $content = FileHelper::getContent(\sprintf('%s/%s', $this->queueFilePath, AvailableBundles::QUEUE_FILE));

        if (empty($content)) {
            $io->error('There is no bundle to install. Go to http://localhost/fitz/install to select the bundles you want to install.');
            return;
        }

        $bundles = \explode(';', $content);

        foreach ($bundles as $bundle) {
            if (empty($bundle)) {
                continue;
            }

            $installerClass = isset(AvailableBundles::BUNDLES[$bundle]['installer_class']) ? AvailableBundles::BUNDLES[$bundle]['installer_class'] : DefaultInstaller::class;
            /** @var AbstractInstaller $installer */
            $installer = new $installerClass($this->composerPath, $this->bundles, $this->projectDir, $this->queueFilePath);
            $installer->setBundleName($bundle);

            if (!$installer->isInstalled()) {
                $io->section(\sprintf('Now installing %s', $bundle));

                $installer->install();

                $io->success(\sprintf('%s installed successfully', $bundle));
            }
        }

        $io->success('All bundles are now installed. Enjoy !');
    }
}