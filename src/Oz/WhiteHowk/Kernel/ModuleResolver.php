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

    private $_namespaces;

    public function __construct(){
        $this->_namespaces = [];
    }

    /**
     * Here module initialization workflow exists
     * 1. Instantiate module providers
     * 2. Make dependency tree
     * 3. Load modules contexts
     */
    public function initializeModule($namespace){
        $providerName = $namespace.'\\'.self::MODULE_PROVIDER_CLASS_NAME;
        if(!class_exists($providerName)){
            throw new \Exception('NoModuleProvider');
        }

        $provider = new $providerName();
        if(!($provider instanceof ModuleProviderInterface)){
            throw new \Exception('Bad Module provider');
        }

        $this->_namespaces[$namespace] = $provider;
    }

    public function getModuleDirectory($moduleProviderClass){
        $r = new \ReflectionClass($moduleProviderClass);
        return dirname($r->getFileName());
    }
} 