<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 23.09.14
 * Time: 1:50
 */

namespace Oz\WhiteHowk\Module\Core\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterDocumentFieldTypeResolverPass implements CompilerPassInterface{
    protected $_resolverName= 'core.document_field_type_resolver';

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $resolverDefinition = $container->getDefinition($this->_resolverName);

        foreach($container->findTaggedServiceIds('document.field_type_provider') as $id=>$args){
            $resolverDefinition->addMethodCall('addProvider', array($container->getDefinition($id)));
        }
    }


} 