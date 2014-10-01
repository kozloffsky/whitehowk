<?php
/**
 * Created by PhpStorm.
 * User: mikeoz
 * Date: 16.09.14
 * Time: 19:20
 */

namespace Oz\WhiteHowk\Console;


use Oz\WhiteHowk\Kernel\Kernel;

class Application extends \Symfony\Component\Console\Application{

    public function __construct(){
        parent::__construct();

        $kernel = new Kernel(getcwd());

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