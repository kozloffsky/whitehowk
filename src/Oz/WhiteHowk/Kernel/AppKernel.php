<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 0:21
 */

namespace Oz\WhiteHowk\Kernel;


/**
 * Class AppKernel
 * @package Oz\WhiteHowk\Kernel
 */
class AppKernel {
    private $_moduleResolver;

    public function setModuleResolver(ModuleResolver $moduleResolver){
        $this->_moduleResolver = $moduleResolver;
    }

    public function getModuleResolver(){
        return $this->_moduleResolver;
    }

    public function boot(){

    }

    public function registerEventDispatcher(){
        
    }

} 