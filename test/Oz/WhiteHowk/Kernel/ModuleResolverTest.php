<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 2:08
 */

namespace Oz\WhiteHowk\Kernel;


class ModuleResolverTest extends \PHPUnit_Framework_TestCase{

    private $_provider;

    public function setUp(){
        $this->_provider = new ContainerProvider();
        $this->_provider->addContext(__DIR__.DIRECTORY_SEPARATOR.'applicationContext.xml');
    }

    public function testGetModulePath(){
        $resolver = new ModuleResolver();
        $path = $resolver->getModuleDirectory('\Oz\WhiteHowk\Kernel\ModuleResolverTest');
        $this->assertEquals($path, __DIR__);

        $path = $resolver->getModuleDirectory($this);
        $this->assertEquals($path, __DIR__);
    }


}