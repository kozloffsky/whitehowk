<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/30/14
 * Time: 17:23
 */

namespace Oz\WhiteHowk\Module\Security;


use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ModuleProvider implements ModuleProviderInterface{
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName()
    {
        "oz/security";
    }

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency()
    {
        return array(
            "oz/core"
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