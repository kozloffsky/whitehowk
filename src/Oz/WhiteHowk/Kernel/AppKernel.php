<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 0:21
 */

namespace Oz\WhiteHowk\Kernel;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class AppKernel
 * @package Oz\WhiteHowk\Kernel
 */
class AppKernel {
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    private $_eventDispatcher;

    public function setModuleResolver(ModuleResolver $moduleResolver){
        $this->_moduleResolver = $moduleResolver;
    }

    public function getModuleResolver(){
        return $this->_moduleResolver;
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher){
        $this->_eventDispatcher = $dispatcher;
    }

    public function boot(){
        $this->_moduleResolver->resolve();

        $this->_eventDispatcher->dispatch(KernelEvent::BOOT, new KernelEvent());
    }
}