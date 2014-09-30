<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/25/14
 * Time: 18:04
 */

namespace Oz\WhiteHowk\Module\Page\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ServiceResolverPass implements CompilerPassInterface{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $serviceResolverId = 'page.service_resolver';
        $resolverDefinition = $container->getDefinition($serviceResolverId);
        foreach($container->findTaggedServiceIds('page.remote_service') as $id=>$params){
            foreach($params as $param){
                $methods = explode(',',$param['methods']);
                $resolverDefinition->addMethodCall('addService', array($id, $container->getDefinition($id), $methods));
            }
        }
    }

} 