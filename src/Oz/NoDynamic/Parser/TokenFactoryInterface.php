<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 17:45
 */

namespace Oz\NoDynamic\Parser;


interface TokenFactoryInterface {
    /**
     * @param $name
     * @return TokenInterface
     */
    public function getToken($name);
} 