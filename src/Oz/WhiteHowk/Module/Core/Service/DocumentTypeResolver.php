<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 22.09.14
 * Time: 21:53
 */

namespace Oz\WhiteHowk\Module\Core\Service;


/**
 * Works with DocumentTypeProvider collection and create or remove document types.
 * Class DocumentTypeResolver
 * @package Oz\WhiteHowk\Module\Core\Service
 */
class DocumentTypeResolver {

    private $_typeProviders;

    public function __construct(){
        $this->_typeProviders = array();
    }

} 