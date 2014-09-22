<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 21.09.14
 * Time: 17:09
 */

namespace Oz\WhiteHowk\Module\Core;

use Oz\WhiteHowk\Kernel\ModuleProviderInterface;
use Oz\WhiteHowk\Module\Core\DependencyInjection\RegisterDocumentFieldTypeResolverPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

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
     * Configure module services and provide shared, register compiler passes.
     *
     * @param ContainerBuilder $container
     * @return void
     */
    public function boot(ContainerBuilder $container)
    {
        $container->setDefinition('core.document_field_type_resolver', new Definition('Oz\WhiteHowk\Module\Core\Service\DocumentFieldTypeResolver'));
        $container->addCompilerPass(new RegisterDocumentFieldTypeResolverPass());
    }

} 