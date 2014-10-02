<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/1/14
 * Time: 22:06
 */

namespace Oz\NoDynamic\Console;


use Oz\WhiteHowk\Kernel\Kernel;

class Application extends \Symfony\Component\Console\Application{

    public function __construct(){
        parent::__construct('NoDynamic');

        $kernel = new Kernel(getcwd(),'config','nodynamic');

        $container = $kernel->getContainerProvider();
        $context = $container->provide();

        $kernel->getModuleResolver()->resolve();
        $container->compile();

        $commands = $context->findTaggedServiceIds('cli.command');

        foreach($commands as $commandId=>$data){
            $this->add($context->get($commandId));
        }
    }

} 