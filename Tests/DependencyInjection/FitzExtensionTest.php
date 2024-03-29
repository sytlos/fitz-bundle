<?php

namespace HugoSoltys\FitzBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use HugoSoltys\FitzBundle\DependencyInjection\FitzExtension;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class FitzExtensionTest extends TestCase
{
    public function setUp()
    {
        if (!class_exists('Symfony\Component\DependencyInjection\ContainerBuilder')) {
            $this->markTestSkipped('The DependencyInjection component is not available.');
        }
    }

    public function testComposerPathParam()
    {
        $container = $this->load([['composer_path' => '/path/to/composer']]);

        $this->assertTrue($container->hasParameter('fitz.composer_path'));
        $param = $container->getParameter('fitz.composer_path');

        $this->assertEquals('/path/to/composer', (string) $param);
    }

    public function testMissingComposerPathParam()
    {
        $container = $this->load([[]]);

        $this->assertTrue($container->hasParameter('fitz.composer_path'));
        $param = $container->getParameter('fitz.composer_path');

        $this->assertEquals('/usr/local/bin/composer', (string) $param);
    }

    public function testHasServices()
    {
        $container = $this->load([[]]);

        $this->assertTrue($container->hasDefinition('fitz.default_installer'));
        $this->assertTrue($container->hasDefinition('fitz.fos_user_installer'));
        $this->assertTrue($container->hasDefinition('fitz.install_command'));
        $this->assertTrue($container->hasDefinition('fitz.controller'));
    }

    private function load(array $configs)
    {
        $container = new ContainerBuilder();

        $extension = new FitzExtension();
        $extension->load($configs, $container);

        return $container;
    }
}
