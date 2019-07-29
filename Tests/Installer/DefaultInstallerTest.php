<?php

namespace HugoSoltys\FitzBundle\Tests\Installer;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use PHPUnit\Framework\TestCase;
use HugoSoltys\FitzBundle\Installer\DefaultInstaller;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class DefaultInstallerTest extends TestCase
{
    public function testIsInstalled()
    {
        $installer = new DefaultInstaller('/usr/local/bin/composer', ['MyBundle' => 'MyBundle'], '/path/to/my/project', '/var/www');
        $installer->setBundleName('MyBundle');

        $this->assertTrue($installer->isInstalled());
    }

    public function testIsNotInstalled()
    {
        $installer = new DefaultInstaller('/usr/local/bin/composer', [], '/path/to/my/project', '/var/www');
        $installer->setBundleName('MyBundle');

        $this->assertFalse($installer->isInstalled());
    }

    public function testIsQueued()
    {
        $queueFilePath = \sprintf('%s/../../', __DIR__);
        FileHelper::append(\sprintf('%s/%s', $queueFilePath, AvailableBundles::QUEUE_FILE), 'MyBundle;');

        $installer = new DefaultInstaller('/usr/local/bin/composer', [], '/path/to/my/project', \sprintf('%s/../../', __DIR__));
        $installer->setBundleName('MyBundle');

        $this->assertTrue($installer->isQueued());

        FileHelper::remove(\sprintf('%s/%s', $queueFilePath, AvailableBundles::QUEUE_FILE), 'MyBundle;');
    }

    public function testIsNotQueued()
    {
        $installer = new DefaultInstaller('/usr/local/bin/composer', [], '/path/to/my/project', \sprintf('%s/../../', __DIR__));
        $installer->setBundleName('MyBundle');

        $this->assertFalse($installer->isQueued());
    }
}