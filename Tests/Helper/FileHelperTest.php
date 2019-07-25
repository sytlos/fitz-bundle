<?php

namespace HugoSoltys\FitzBundle\Tests\Helper;

use PHPUnit\Framework\TestCase;
use HugoSoltys\FitzBundle\Helper\FileHelper;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class FileHelperTest extends TestCase
{
    public function testGetContent()
    {
        $helper = new FileHelper();
        $helper->append('test_file.log', 'test_append');

        $this->assertEquals($helper->getContent('test_file.log'), 'test_append');

        \unlink('test_file.log');
    }

    public function testContains()
    {
        $helper = new FileHelper();
        $helper->append('test_file.log', 'test_contains');

        $this->assertTrue($helper->contains('test_file.log', 'test_contains'));

        \unlink('test_file.log');
    }

    public function testRemove()
    {
        $helper = new FileHelper();
        $helper->append('test_file.log', 'test_remove');

        $this->assertEquals($helper->getContent('test_file.log'), 'test_remove');

        $helper->remove('test_file.log', 'test_remove');

        $this->assertEquals($helper->getContent('test_file.log'), '');

        \unlink('test_file.log');
    }
}