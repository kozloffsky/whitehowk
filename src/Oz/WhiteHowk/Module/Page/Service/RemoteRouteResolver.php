<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 30.09.14
 * Time: 3:11
 */

namespace Oz\WhiteHowk\Module\Page\Service;


use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RemoteRouteResolver {
    /**
     * @var \Symfony\Component\Routing\RouteCollection
     */
    protected $_routesCollection;

    public function __construct(){
        $this->_routesCollection = new RouteCollection();
    }

    /**
     * @param \ArrayObject $routes
     */
    public function addRoutes(\ArrayObject $routes){
        foreach($routes as $collection){
            $this->_routesCollection->add(
                $collection['name'],
                new Route(
                    $path = $collection['path'],
                    $options = array('component'=>$collection['component'])
                ));
        }
    }

    /**
     * @return RouteCollection
     */
    public function resolve(){
        return $this->_routesCollection;
    }
} 