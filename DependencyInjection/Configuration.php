<?php

namespace HugoSoltys\FitzBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder('fitz');
        if (\method_exists($builder, 'getRootNode')) {
            $rootNode = $builder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $builder->root('fitz');
        }

        $rootNode
            ->children()
                ->scalarNode('composer_path')->defaultValue('/usr/local/bin/composer')->end()
                ->scalarNode('queue_file_path')->defaultValue('%kernel.project_dir%/vendor/hugosoltys/fitz-bundle')->end()
            ->end()
        ;

        return $builder;
    }
}