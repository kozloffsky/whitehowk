<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 2:17
 */

namespace Oz\WhiteHowk\Kernel\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EagerServicePass
 * @package Oz\WhiteHowk\Kernel\DependencyInjection
 */
class EagerServicePass implements CompilerPassInterface {
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $defs = $container->findTaggedServiceIds('service.eager');
        foreach($defs as $id=>$props){
            //Simply call get to instantiate service
            $container->get($id);
        }
    }

} 