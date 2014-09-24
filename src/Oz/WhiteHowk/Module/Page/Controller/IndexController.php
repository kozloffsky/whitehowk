<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 2:29
 */

namespace Oz\WhiteHowk\Module\Page\Controller;

use Oz\WhiteHowk\Module\Core\Service\DocumentFieldTypeResolver;

class IndexController {

    public function __construct(DocumentFieldTypeResolver $resolver){
        //var_dump($resolver);
    }

    public function indexAction(){
        return "";
    }
}