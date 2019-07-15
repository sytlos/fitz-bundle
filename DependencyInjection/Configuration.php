<?php

namespace HugoSoltys\FitzBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
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
            ->end()
        ;

        return $builder;
    }
}