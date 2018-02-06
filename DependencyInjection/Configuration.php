<?php

namespace Disjfa\MozaicBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('disjfa_mozaic');

        $rootNode
            ->children()
            ->arrayNode('unsplash')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('application_id')->defaultValue('')->end()
            ->scalarNode('secret')->defaultValue('')->end()
            ->end()
            ->end() // twitter
            ->end()
        ;

        return $treeBuilder;
    }
}
