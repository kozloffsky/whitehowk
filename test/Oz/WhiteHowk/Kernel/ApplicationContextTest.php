<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 15:18
 */

namespace Oz\WhiteHowk\Kernel;


class ApplicationContextTest extends \PHPUnit_Framework_TestCase{

    private $_provider;

    public function setUp(){
        $this->_provider = new ContainerProvider();
        $this->_provider->addContext(__DIR__.DIRECTORY_SEPARATOR.'applicationContext.xml');
    }

    public function testKernelService(){
        $context = $this->_provider->provide();
        $kernel = $context->get('kernel.app_kernel');
        $this->assertNotNull($kernel);

        $moduleProvider = $kernel->getModuleResolver();
        $this->assertNotNull($moduleProvider);
        $this->assertSame($moduleProvider, $context->get('kernel.module_resolver'));
    }

} 