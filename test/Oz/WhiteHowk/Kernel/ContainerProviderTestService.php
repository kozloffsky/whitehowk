<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 23:58
 */

namespace Oz\WhiteHowk\Kernel;


class ContainerProviderTestService {
    private $_testInstance;

    public function __construct(){

    }

    public function set(ContainerProviderTestService $testService){
        $this->_testInstance = $testService;
    }

    public function get(){
        return $this->_testInstance;
    }
} 