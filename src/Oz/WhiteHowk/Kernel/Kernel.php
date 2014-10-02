<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 0:21
 */

namespace Oz\WhiteHowk\Kernel;
use Oz\WhiteHowk\Kernel\Aop\ProxyGenerator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AppKernel
 * @package Oz\WhiteHowk\Kernel
 */
class Kernel {
    /**
     * @var ModuleResolver
     */
    protected $_moduleResolver;

    /**
     * @var EventDispatcher
     */
    protected $_eventDispatcher;

    /**
     * @var ContainerProvider
     */
    protected  $_containerProvider;

    /**
     * AppKernel constructor. Initializes DI and other services
     * @param $rootPath
     * @param $configPath
     * @param $contextName
     * @throws ConfigurationException
     */
    public function __construct($rootPath, $configPath = 'config',$contextName = 'applicationContext'){
        $this->_containerProvider = new ContainerProvider();
        $this->_containerProvider->provide()->setParameter('root', $rootPath);
        $this->_containerProvider->addContext($rootPath.DIRECTORY_SEPARATOR.$configPath.DIRECTORY_SEPARATOR.$contextName.'.xml');

        $this->_moduleResolver = new ModuleResolver($this->_containerProvider);
        $this->_moduleResolver->setNamespaces($this->_containerProvider->provide()->getParameter('modules'));
        $this->_containerProvider->provide()->set('kernel.module_resolver', $this->_moduleResolver);

    }

    /**
     * @param ModuleResolver $moduleResolver
     */
    public function setModuleResolver(ModuleResolver $moduleResolver){
        $this->_moduleResolver = $moduleResolver;
    }

    /**
     * @return ModuleResolver
     */
    public function getModuleResolver(){
        return $this->_moduleResolver;
    }

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $dispatcher){
        $this->_eventDispatcher = $dispatcher;
    }


    /**
     * @return ContainerProvider
     */
    public function getContainerProvider(){
        return $this->_containerProvider;
    }


    /**
     * Here all boot logic.
     * Modules initialization and bootstrapping.
     * Request bootstrap.
     * Controller dispatching
     */
    public function boot(){
        $this->_moduleResolver->resolve();

        $this->initAop();

        $this->_containerProvider->compile();

        $this->_eventDispatcher = $this->_containerProvider->provide()->get('event_dispatcher');

        $this->_eventDispatcher->dispatch(KernelEvent::BOOT, new KernelEvent(null, null));
    }


}