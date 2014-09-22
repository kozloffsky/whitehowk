<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 22:39
 */

namespace Oz\WhiteHowk\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class Application
 * This class controls given workflow
 * 1. Initialize DI container
 * 2. Retrieve Kernel
 * 3. Boot kernel
 * 3. initialize request
 * 4. Generate response
 *
 * TODO: Should application provide public API?
 * TODO: Move AppKernel and ModuleResolver out from context
 * TODO: Seems that AppKernel and Application can be merged into one class AppKernel
 * @package Oz\WhiteHowk\Kernel
 */
class Application {

    const CONFIG_DIR_NAME = 'config';

    private $_rootDir;
    private $_env;
    private $_autoloader;

    /**
     * Constructor
     * @param $root
     * @param $env
     */
    private function __construct($root, $env){
        $this->_rootDir = $root;
        $this->_env = $env;
        $this->init();
    }

    /**
     *
     */
    private function init(){
        $this->initializeAutoloader();
        $kernel = $this->initializeKernel();
        $kernel->boot();
    }

    /**
     *
     */
    private function initializeAutoloader(){
        $this->_autoloader = require $this->_rootDir.DIRECTORY_SEPARATOR
            .'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
    }

    private function initializeKernel(){
        $kernel = new AppKernel($this->_rootDir);
        return $kernel;
    }

    public static function run($root, $env = "prod"){
        return new Application($root, $env);
    }

} 