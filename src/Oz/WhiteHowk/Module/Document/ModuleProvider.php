<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 30.09.14
 * Time: 2:18
 */

namespace Oz\WhiteHowk\Module\Document;


use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ModuleProvider implements ModuleProviderInterface
{
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName()
    {
        return 'oz/document';
    }

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency()
    {
        return array(
            'oz/core',
            'oz/page'
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

    }

}