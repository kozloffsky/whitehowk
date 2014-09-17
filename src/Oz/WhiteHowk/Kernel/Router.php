<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 1:26
 */

namespace Oz\WhiteHowk\Kernel;


use Oz\WhiteHowk\Kernel\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Router {
    use ContainerAware;

    public function route(Request $request){
        $controllers = $this->_container->findTaggedServiceIds('router.route');

        $routeCollection = new RouteCollection();

        //TODO: Add full support for routes
        foreach($controllers as $id=>$routes){
            foreach($routes as $route){
                $routeCollection->add($id.$route['method'], new Route( $route['path'], array('_controller' => $id,'_method'=>$route['method'])));
            }
        }

        $requestContext = new RequestContext();
        $requestContext->fromRequest($request);
        $matcher = new UrlMatcher($routeCollection, $requestContext);

        //Add controller and parameters attributes to request
        //TODO: add exception handler and forward to 404 or error controller
        $request->attributes->add($matcher->matchRequest($request));
        var_dump($request->attributes);

        return $request;
    }
}