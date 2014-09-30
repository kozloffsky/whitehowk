<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 29.09.14
 * Time: 3:17
 */

namespace Oz\WhiteHowk\Module\Page\Service;


use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class HashRouterService {

    /**
     * @var RemoteRouteResolver
     */
    protected $_routeResolver;

    /**
     * Constructor
     */
    public function __construct(RemoteRouteResolver $resolver){
        $this->_routeResolver = $resolver;
    }

    public function route($hash){
        $routeCollection = $this->_routeResolver->resolve();
        $matcher = new UrlMatcher($routeCollection, new RequestContext());
        try{
            $resource = $matcher->match('/'.$hash);
        }catch(ResourceNotFoundException $e){
            return array('component'=>'error-page','error'=>$e->getMessage());
        }
        return $resource;
    }

} 