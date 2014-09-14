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

    private $_namespaces;

    public function __construct($namespaces){
        $this->_namespaces;
    }

    /**
     * Here module initialization workflow exists
     * 1. Instantiate module providers
     * 2. Make dependency tree
     * 3. Load modules contexts
     */
    public function initializeModules(){

    }
} 