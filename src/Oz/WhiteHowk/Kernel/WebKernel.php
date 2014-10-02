<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 01.10.14
 * Time: 23:54
 */

namespace Oz\WhiteHowk\Kernel;


use Oz\WhiteHowk\Kernel\Aop\ProxyGenerator;
use Symfony\Component\HttpFoundation\Request;

class WebKernel extends Kernel{

    /**
     * @var Router
     */
    protected $_router;

    /**
     * @var ControllerDispatcher
     */
    protected $_controllerDispatcher;

     /**
     * AppKernel constructor. Initializes DI and other services
     * @param $rootPath
     * @param $configPath
     * @throws ConfigurationException
     */
    public function __construct($rootPath, $configPath = 'config'){
        parent::__construct($rootPath, $configPath);

        $this->_router = new Router();
        $this->_router->setContainer($this->_containerProvider->provide());
        $this->_containerProvider->provide()->set('kernel.router', $this->_router);

        $this->_controllerDispatcher = new ControllerDispatcher();
        $this->_controllerDispatcher->setContainer($this->_containerProvider->provide());
        $this->_containerProvider->provide()->set('kernel.controller_dispatcher', $this->_controllerDispatcher);
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router){
        $this->_router = $router;
    }

    /**
     * @return \Oz\WhiteHowk\Kernel\Router
     */
    public function getRouter()
    {
        return $this->_router;
    }

    /**
     * @param ControllerDispatcher $controllerDispatcher
     */
    public function setControllerDispatcher(ControllerDispatcher $controllerDispatcher)
    {
        $this->_controllerDispatcher = $controllerDispatcher;
    }

    /**
     * Here all boot logic.
     * Modules initialization and bootstrapping.
     * Request bootstrap.
     * Controller dispatching
     */
    public function boot(){
        parent::boot();

        $request = Request::createFromGlobals();
        $this->_router->route($request);

        //TODO: move Dispatch events to ControllerDispatcherEvent
        $this->_eventDispatcher->dispatch(KernelEvent::PRE_DISPATCH, new KernelEvent($request, null));
        $response = $this->_controllerDispatcher->dispatch($request);
        $this->_eventDispatcher->dispatch(KernelEvent::POST_DISPATCH, new KernelEvent($request, $response));
        $response->send();
    }

    protected function initAop(){
        $container = $this->_containerProvider->provide();
        $generator = new ProxyGenerator($container->getParameter('root').'/cache/proxy/');
        foreach($container->getDefinitions() as $id => $definition){
            $oldClass = $definition->getClass();
            //TODO: make only no_proxy methods that marked as event listeners for method invoke events
            if($id == 'event_dispatcher' || $definition->hasTag('kernel.no_proxy')){
                continue;
            }
            $definition->setClass($generator->generate($oldClass));

            $arguments = $definition->getArguments();
            $newArgs = array($container->getDefinition('event_dispatcher'));
            foreach($arguments as $argument){
                array_push($newArgs, $argument);
            }
            $definition->setArguments($newArgs);
        }
    }




}