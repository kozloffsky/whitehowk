<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 0:21
 */

namespace Oz\WhiteHowk\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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

    private $_containerProvider;

    public function __construct($rootPath){
        $this->_containerProvider = new ContainerProvider();
        $this->_containerProvider->provide()->setParameter('root', $rootPath);

        $this->_moduleResolver = new ModuleResolver($this->_containerProvider);
        $this->_moduleResolver->setNamespaces(include $rootPath.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'modules.php');
        $this->_containerProvider->provide()->set('kernel.module_resolver', $this->_moduleResolver);

        $this->_router = new Router();
        $this->_router->setContainer($this->_containerProvider->provide());

        $this->_controllerDispatcher = new ControllerDispatcher();
        $this->_controllerDispatcher->setContainer($this->_containerProvider->provide());
    }

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

        $this->_containerProvider->compile();

        $this->_eventDispatcher = $this->_containerProvider->provide()->get('event_dispatcher');

        $this->_eventDispatcher->dispatch(KernelEvent::BOOT, new KernelEvent(null, null));

        $request = Request::createFromGlobals();
        $this->_router->route($request);
        $this->_eventDispatcher->dispatch(KernelEvent::PRE_DISPATCH, new KernelEvent($request, null));
        $response = $this->_controllerDispatcher->dispatch($request);
        $this->_eventDispatcher->dispatch(KernelEvent::POST_DISPATCH, new KernelEvent($request, $response));
        $response->send();
    }
}