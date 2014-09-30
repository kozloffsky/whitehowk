<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 30.09.14
 * Time: 3:13
 */

namespace Oz\WhiteHowk\Module\Page\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RemoteRouteResolverPass implements CompilerPassInterface {
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $serviceResolverId = 'page.remote_route_resolver';
        $resolverDefinition = $container->getDefinition($serviceResolverId);
        foreach($container->findTaggedServiceIds('page.remote_routes_collection') as $id=>$params){
            $resolverDefinition->addMethodCall('addRoutes', array($container->getDefinition($id)));
        }
    }


} 