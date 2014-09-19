<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/19/14
 * Time: 16:23
 */

namespace Oz\WhiteHowk\Composition\Config;


use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class LayoutConfiguration
 * @package Oz\WhiteHowk\Composition\Config
 */
class LayoutConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('layout');

        $rootNode
            ->children()
                ->arrayNode('')
            ->end();
    }

}