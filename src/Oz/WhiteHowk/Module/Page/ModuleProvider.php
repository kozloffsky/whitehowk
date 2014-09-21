<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 14:59
 */

namespace Oz\WhiteHowk\Module\Page;


use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ModuleProvider implements ModuleProviderInterface{
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName()
    {
        return 'oz/page';
    }

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency()
    {
        return array(
            'oz/core',
            'oz/twig'
        );
    }

    /**
     * Configure module services and provide shared
     *
     * @param ContainerBuilder $container
     * @return void
     */
    public function boot(ContainerBuilder $container)
    {
        // TODO: Implement boot() method.
    }

}