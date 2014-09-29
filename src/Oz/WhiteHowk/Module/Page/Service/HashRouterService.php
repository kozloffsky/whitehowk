<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 29.09.14
 * Time: 3:17
 */

namespace Oz\WhiteHowk\Module\Page\Service;


class HashRouterService {

    public function route($args){
        return array('component'=>'home','componentName'=>'home-page');
    }

} 