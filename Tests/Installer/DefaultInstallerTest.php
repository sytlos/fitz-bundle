<?php

namespace HugoSoltys\FitzBundle\Tests\Installer;

use PHPUnit\Framework\TestCase;
use HugoSoltys\FitzBundle\Installer\DefaultInstaller;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class DefaultInstallerTest extends TestCase
{
    public function testIsInstalled()
    {
        $installer = new DefaultInstaller('/usr/local/bin/composer', ['MyBundle' => 'MyBundle'], '/path/to/my/project');
        $installer->setBundleName('MyBundle');

        $this->assertTrue($installer->isInstalled());
    }

    public function testIsNotInstalled()
    {
        $installer = new DefaultInstaller('/usr/local/bin/composer', [], '/path/to/my/project');
        $installer->setBundleName('MyBundle');

        $this->assertFalse($installer->isInstalled());
    }
}