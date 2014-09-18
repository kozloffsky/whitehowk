<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 22:58
 */

namespace Oz\WhiteHowk\Kernel;


use Oz\WhiteHowk\Kernel\DependencyInjection\EagerServicePass;
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
        $this->_builder->addCompilerPass(new EagerServicePass());
    }

    protected function registerEventDispatcher(){
        $listener = new Definition('Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher');
        $listener->addArgument($this->_builder);
        $this->_builder->setDefinition(
            'event_dispatcher',
            $listener
        );
        //$this->_builder->addCompilerPass( new RegisterListenersPass());
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

    public function process(){
        $eventListener = $this->_builder->get('event_dispatcher');
        foreach ($this->_builder->findTaggedServiceIds('kernel.event_listener') as $id => $events) {
            foreach ($events as $event) {
                $priority = isset($event['priority']) ? $event['priority'] : 0;

                if (!isset($event['event'])) {
                    throw new \InvalidArgumentException(sprintf('Service "%s" must define the "event" attribute on "%s" tags.', $id, $this->listenerTag));
                }

                if (!isset($event['method'])) {
                    $event['method'] = 'on'.preg_replace_callback(array(
                            '/(?<=\b)[a-z]/i',
                            '/[^a-z0-9]/i',
                        ), function ($matches) { return strtoupper($matches[0]); }, $event['event']);
                    $event['method'] = preg_replace('/[^a-z0-9]/i', '', $event['method']);
                }

                $eventListener->addListenerService($event['event'], array($id, $event['method']), $priority);
            }
        }
    }
} 