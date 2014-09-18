<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 16.09.14
 * Time: 2:32
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class KernelEvent extends Event {

    const BOOT = 'kernel.boot';
    const PRE_DISPATCH = 'kernel.pre_dispatch';
    const POST_DISPATCH = 'kernel.post_dispatch';

    private $_request;
    private $_response;

    public function __construct($request, $response){
        $this->_request = $request;
        $this->_response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->_response;
    }





} 