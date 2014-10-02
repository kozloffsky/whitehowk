<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/24/14
 * Time: 20:07
 */

namespace Oz\WhiteHowk\Module\Page\Controller;


use Oz\WhiteHowk\Module\Page\Controller\Exception\ServiceErrorException;
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
        $status = "ok";

        try{
            $result = $this->_serviceResolver->callServiceMethod($jsonRequest['service'], $jsonRequest['method'], $jsonRequest['args']);
        }catch (ServiceErrorException $ex){
            $result = array('errors'=>$ex->getData());
            $status = "error";
        }catch(\Exception $e){
            $status = "error";
            $result = array('errors'=>array($e->getMessage()));
        }

        return new JsonResponse(array('status'=>$status, 'result'=>$result));
    }



} 