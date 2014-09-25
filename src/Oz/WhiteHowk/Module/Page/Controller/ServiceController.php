<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/24/14
 * Time: 20:07
 */

namespace Oz\WhiteHowk\Module\Page\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ServiceController {

    protected $_modelClass;

    public function dispatch(Request $request){
        return new JsonResponse(array('status'=>'ok','component'=>'home','componentName'=>'home-page'));
    }

} 