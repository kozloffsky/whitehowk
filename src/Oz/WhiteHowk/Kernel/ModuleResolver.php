<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 1:23
 */

namespace Oz\WhiteHowk\Kernel;


/**
 * Class ModuleResolver
 * This class searches validates and initializes modules from given array of namespaces
 * @package Oz\WhiteHowk\Kernel
 */
class ModuleResolver {
    const CONFIG_PATH = 'config';
    const RESOURCES_PATH = 'Resources';
    const MODULE_PROVIDER_CLASS_NAME = 'ModuleProvider';

    private $_providers;

    /**
     * Array of initialized modules
     * @var array
     */
    private $_modules;


    /**
     * @var ContainerProvider
     */
    private $_containerProvider;

    public function __construct(){
        $this->_providers = array();
    }

    /**
     * Here module initialization workflow exists
     * 1. Instantiate module providers
     * 2. Make dependency tree
     * 3. Load modules contexts
     */
    public function registerModule($namespace){
        $providerName = $namespace.'\\'.self::MODULE_PROVIDER_CLASS_NAME;
        if(!class_exists($providerName)){
            throw new \Exception('NoModuleProvider');
        }

        $provider = new $providerName();
        if(!($provider instanceof ModuleProviderInterface)){
            throw new \Exception('Bad Module provider');
        }

        $this->_providers[$provider->getName()] = $provider;
    }

    public function setNamespaces($namespaces){
        foreach($namespaces as $ns){
            $this->registerModule($ns);
        }
    }

    public function resolve(){
        foreach($this->_providers as $name=>$provider){
            $this->bootModule($name);
        }
    }

    public function bootModule($name){
        if(!isset($this->_providers[$name])){
            throw new \Exception('module does not registered');
        }

        $provider = $this->_providers[$name];
        $deps = $provider->getDependency();
        foreach($deps as $dependency){
            // module already booted
            if(isset($this->_modules[$dependency])){
                continue;
            }

            //Is dependency registered. if not - throw exception
            if(!isset($this->_providers[$dependency])){
                throw new \Exception('Dependency does not found');
            }

            //Boot dependency
            $this->bootModule($dependency);
        }

        $moduleDir = $this->getModuleDirectory($provider);

        $this->_containerProvider->addContext($moduleDir.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'moduleContext.xml');
    }

    public function setContainerProvider(ContainerProvider $provider){
        $this->_containerProvider = $provider;
    }

    public function getModuleDirectory($moduleProviderClass){
        $r = new \ReflectionClass($moduleProviderClass);
        return dirname($r->getFileName());
    }
} 