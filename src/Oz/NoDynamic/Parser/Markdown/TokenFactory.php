<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 17:48
 */

namespace Oz\NoDynamic\Parser\Markdown;


use Oz\NoDynamic\Parser\Parser;
use Oz\NoDynamic\Parser\TokenFactoryInterface;

class TokenFactory implements TokenFactoryInterface{

    private $tokenClasses = array(
        Parser::TOKEN_H1 => '\Oz\NoDynamic\Parser\Markdown\TokenH1',
        Parser::TOKEN_H2 => '\Oz\NoDynamic\Parser\Markdown\TokenH2'
    );

    public function getToken($name)
    {
        $tokenClass = $this->tokenClasses[$name];
        if(!$tokenClass){
            return null;
        }

        $token = new $tokenClass();

        return $token;
    }

} 