<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 01.10.14
 * Time: 0:46
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;

trait EventDispatcherAware {
    /**
     * @var EventDispatcherInterface
     */
    protected $_eventDispatcher;

    /**
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->_eventDispatcher = $eventDispatcher;
    }

    /**
     * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->_eventDispatcher;
    }



} 