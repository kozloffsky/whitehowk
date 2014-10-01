<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 01.10.14
 * Time: 4:43
 */

namespace Oz\WhiteHowk\Module\Security\Core;


use Oz\WhiteHowk\Kernel\Aop\MethodPreInvokeEvent;
use Oz\WhiteHowk\Kernel\KernelEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccessManager
 * @package Oz\WhiteHowk\Module\Security\Core
 */
class AccessManager {

    /**
     * @var Request
     */
    protected $_request;

    /**
     * @param KernelEvent $event
     */
    public function onPreDispatch(KernelEvent $event){
        $this->_request = $event->getRequest();
    }

    public function onMethodPreInvoke(MethodPreInvokeEvent $event){

    }

} 