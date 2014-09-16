<?php
/**
 * Created by PhpStorm.
 * User: mikeoz
 * Date: 16.09.14
 * Time: 19:20
 */

namespace Oz\WhiteHowk\Console;


use Oz\WhiteHowk\Kernel\ContainerProvider;

class Application extends \Symfony\Component\Console\Application{

    public function __construct(){
        parent::__construct();

        $container = new ContainerProvider();
        $container->addContext(getcwd().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'applicationContext.xml');
        $context = $container->provide();

        $commands = $context->findTaggedServiceIds('cli.command');

        foreach($commands as $commandId=>$data){
            $this->add($context->get($commandId));
        }
    }
} 