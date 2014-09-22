<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 23.09.14
 * Time: 1:32
 */

namespace Oz\WhiteHowk\Module\Core\Service;


use Oz\WhiteHowk\Module\Core\Document\DocumentFieldTypeProviderInterface;

class DocumentFieldTypeResolver {

    private $_providers;

    public function __construct(){
        $this->_providers = array();
    }

    public function getProviderForType($name){

    }

    public function addProvider(DocumentFieldTypeProviderInterface $provider){
        $this->_providers[$provider->getName()] = $provider;
    }

} 