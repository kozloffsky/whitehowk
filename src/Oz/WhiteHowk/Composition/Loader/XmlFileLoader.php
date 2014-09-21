<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 20.09.14
 * Time: 15:39
 */

namespace Oz\WhiteHowk\Composition\Loader;
use Symfony\Component\Config\Loader\FileLoader;
use Zend\Config\Config;
use Zend\Config\Reader\Xml;


/**
 * Class XmlFileLoader
 * Lads xml layout declaration and convert it to array
 * @package Oz\WhiteHowk\Composition\Loader
 */
class XmlFileLoader extends FileLoader {

    public function load($resource, $type = null)
    {
        $resource = new Xml();
        return new Config($resource->fromFile($resource));
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'xml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }

} 