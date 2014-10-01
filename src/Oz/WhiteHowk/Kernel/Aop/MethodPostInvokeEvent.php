<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 01.10.14
 * Time: 1:52
 */

namespace Oz\WhiteHowk\Kernel\Aop;


class MethodPostInvokeEvent extends MethodPreInvokeEvent{

    protected $result;

    const POST_INVOKE_EVENT = 'method.post_invoke';

    public function __construct($result, $args, $methodName, $object)
    {
        parent::__construct($args, $methodName, $object);
        $this->result = $result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }




} 