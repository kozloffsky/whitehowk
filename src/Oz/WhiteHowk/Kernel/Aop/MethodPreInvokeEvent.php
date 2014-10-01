<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 01.10.14
 * Time: 1:37
 */

namespace Oz\WhiteHowk\Kernel\Aop;


use Symfony\Component\EventDispatcher\Event;

class MethodPreInvokeEvent extends Event {

    protected $args;

    protected $object;

    protected $methodName;

    function __construct($args, $methodName, $object)
    {
        $this->args = $args;
        $this->methodName = $methodName;
        $this->object = $object;
        echo "Method invoked ".$methodName.''.get_class($object)."\n";
    }

    /**
     * @param mixed $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $methodName
     */
    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;
    }

    /**
     * @return mixed
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }


} 