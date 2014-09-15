<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 16.09.14
 * Time: 1:45
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\EventDispatcher\Event;

class TestEventListener {

    private $_dispatched = false;

    public function onTestEvent(Event $event){
        $this->_dispatched = true;
    }

    public function dispatched(){
        return $this->_dispatched;
    }
} 