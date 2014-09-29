<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 25.09.14
 * Time: 23:49
 */

namespace Oz\WhiteHowk\Module\Page\Service;


/**
 * This proxy wraps service object and controls it public methods execution
 * Class ServiceProxy
 * @package Oz\WhiteHowk\Module\Page\Service
 */
class ServiceProxy
{

    protected $_instance;
    protected $_allowedMethods;

    public function __construct($instance)
    {
        $this->_instance = $instance;
        $this->_allowedMethods = array();
    }

    public function allowMethods($methods)
    {
        foreach ($methods as $method) {
            $this->allowMethod($method);
        }
    }

    public function allowMethod($methodName)
    {
        if (in_array($methodName, $this->_allowedMethods)) {
            return;
        }
        $this->_allowedMethods[] = $methodName;
    }

    public function call($methodName, $args)
    {
        if (!in_array($methodName, $this->_allowedMethods)) {
            throw new \Exception('Method ' . $methodName . ' is not shared method');
        }

        if (!method_exists($this->_instance, $methodName)) {
            throw new \Exception('Method does not exists');
        }

        return call_user_func_array(array($this->_instance, $methodName), $args);
    }


} 