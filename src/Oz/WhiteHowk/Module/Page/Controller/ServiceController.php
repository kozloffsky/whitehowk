<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/24/14
 * Time: 20:07
 */

namespace Oz\WhiteHowk\Module\Page\Controller;


use Oz\WhiteHowk\Module\Page\Service\ServiceResolver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ServiceController {

    protected $_modelClass;

    protected $_serviceResolver;

    public function __construct(ServiceResolver $serviceResolver){
        $this->_serviceResolver = $serviceResolver;
    }

    public function dispatch(Request $request){
        $jsonRequest = json_decode($request->getContent(), true);

        $result = $this->_serviceResolver->callServiceMethod($jsonRequest['service'], $jsonRequest['method'], $jsonRequest['args']);

        return new JsonResponse(array('status'=>'ok', 'result'=>$result));
    }



} 