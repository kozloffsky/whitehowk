<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 2:12
 */

namespace Oz\WhiteHowk\Kernel;


use Oz\WhiteHowk\Kernel\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ControllerDispatcher
 * @package Oz\WhiteHowk\Kernel
 */
class ControllerDispatcher {
    use ContainerAware;

    /**
     * @param Request $request
     * @return Response
     */
    public function dispatch(Request $request){
        $controllerName = $request->attributes->get('_controller');
        $methodName = $request->attributes->get('method');
        $controller = $this->_container->get($controllerName);

        $response = call_user_func_array(array($controller, $methodName), array());

        return $this->validateResponse($response);
    }

    /**
     * @param $response
     * @return Response
     */
    protected function validateResponse($response){
        if(is_string($response)){
            $response = new Response($response);
        }

        return $response;
    }
} 