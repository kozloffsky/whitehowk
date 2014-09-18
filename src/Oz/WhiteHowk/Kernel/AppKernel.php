<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 0:21
 */

namespace Oz\WhiteHowk\Kernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AppKernel
 * @package Oz\WhiteHowk\Kernel
 */
class AppKernel {
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    /**
     * @var EventDispatcher
     */
    private $_eventDispatcher;

    private $_router;

    private $_controllerDispatcher;

    public function setModuleResolver(ModuleResolver $moduleResolver){
        $this->_moduleResolver = $moduleResolver;
    }

    public function getModuleResolver(){
        return $this->_moduleResolver;
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher){
        $this->_eventDispatcher = $dispatcher;
    }

    public function setRouter(Router $router){
        $this->_router = $router;
    }

    /**
     * @param ControllerDispatcher $controllerDispatcher
     */
    public function setControllerDispatcher(ControllerDispatcher $controllerDispatcher)
    {
        $this->_controllerDispatcher = $controllerDispatcher;
    }



    public function boot(){
        $this->_moduleResolver->resolve();

        $this->_eventDispatcher->dispatch(KernelEvent::BOOT, new KernelEvent(null, null));

        $request = Request::createFromGlobals();
        $this->_router->route($request);
        $this->_eventDispatcher->dispatch(KernelEvent::PRE_DISPATCH, new KernelEvent($request, null));
        $response = $this->_controllerDispatcher->dispatch($request);
        $this->_eventDispatcher->dispatch(KernelEvent::POST_DISPATCH, new KernelEvent($request, $response));
        $response->send();
    }
}