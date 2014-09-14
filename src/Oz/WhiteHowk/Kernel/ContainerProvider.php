<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 22:58
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class ContainerProvider
 * Class initializes DI container and configures it
 * @package Oz\WhiteHowk\Kernel
 */
class ContainerProvider {
    private $_builder;

    public function __construct(){
        $this->_builder = new ContainerBuilder();
    }

    public function provide(){
        return $this->_builder;
    }

    public function addContext($path){
        $dir= dirname($path);
        $fileName = basename($path);
        $loader = new XmlFileLoader($this->_builder, new FileLocator($dir));
        try{
            $loader->load($fileName);
        }catch (\InvalidArgumentException $e){
            throw new ConfigurationException($e->getMessage());
        }
    }
} 