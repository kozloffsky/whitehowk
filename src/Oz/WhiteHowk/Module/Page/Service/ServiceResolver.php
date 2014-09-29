<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/25/14
 * Time: 18:03
 */

namespace Oz\WhiteHowk\Module\Page\Service;


class ServiceResolver
{

    protected $_services;

    public function addService($id, $service, $methods)
    {
        $proxy = new ServiceProxy($service);
        $proxy->allowMethods($methods);
        $this->_services[$id] = $proxy;
    }

    public function callServiceMethod($id, $method, $args = array())
    {
        if (!$this->hasService($id)) {
            throw new \Exception('Service does not registered');
        }

        $proxy = $this->_services[$id];
        return $proxy->call($method, $args);
    }

    public function hasService($id)
    {
        return array_key_exists($id, $this->_services);
    }

} 