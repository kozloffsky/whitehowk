<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 21.09.14
 * Time: 17:09
 */

namespace Oz\WhiteHowk\Module\Core;

use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ModuleProvider implements ModuleProviderInterface{
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName()
    {
        return 'oz/core';
    }

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency()
    {
        return array();
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