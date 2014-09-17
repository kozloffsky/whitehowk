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

class ControllerDispatcher {
    use ContainerAware;

    public function dispatch(Request $request){
        $controllerName = $request->attributes->get('_controller');
        $methodName = $request->attributes->get('_method');
        $controller = $this->_container->get($controllerName);

        $response = call_user_func_array(array($controller, $methodName), array());
    }
} 