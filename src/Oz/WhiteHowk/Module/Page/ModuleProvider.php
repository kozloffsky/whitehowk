<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 14:59
 */

namespace Oz\WhiteHowk\Module\Page;


use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Oz\WhiteHowk\Module\Page\DependencyInjection\ServiceResolverCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class ModuleProvider implements ModuleProviderInterface
{
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
        $container->setDefinition('page.service_resolver', new Definition('Oz\WhiteHowk\Module\Page\Service\ServiceResolver'));
        $container->addCompilerPass(new ServiceResolverCompilerPass());
    }

}