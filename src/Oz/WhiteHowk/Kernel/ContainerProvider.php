<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 22:58
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;

/**
 * Class ContainerProvider
 * Class initializes DI container and configures it
 * @package Oz\WhiteHowk\Kernel
 */
class ContainerProvider {
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $_builder;

    public function __construct(){
        $this->_builder = new ContainerBuilder();
        $this->_builder->set('container_provider',$this);
        // register the event dispatcher service
        $this->registerEventDispatcher();

    }

    protected function registerEventDispatcher(){
        $listener = new Definition('Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher');
        $listener->addArgument($this->_builder);
        $this->_builder->setDefinition(
            'event_dispatcher',
            $listener
        );
        $this->_builder->addCompilerPass(new RegisterListenersPass());
    }

    public function provide(){
        return $this->_builder;
    }

    public function addContext($path){
        $dir= dirname($path);
        $fileName = basename($path);
        $loader = new XmlFileLoader($this->_builder, new FileLocator($dir));
        try{
            $loader->load($fileName);
        }catch (\InvalidArgumentException $e){
            throw new ConfigurationException($e->getMessage());
        }
    }
} 