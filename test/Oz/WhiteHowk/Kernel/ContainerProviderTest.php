<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 14.09.14
 * Time: 23:19
 */

namespace Oz\WhiteHowk\Kernel;

use \Oz\WhiteHowk\Kernel\ContainerProviderTestService as TS;


class ContainerProviderTest extends \PHPUnit_Framework_TestCase{

    public function testAddContext(){
        $provider = new ContainerProvider();
        $provider->addContext(__DIR__.DIRECTORY_SEPARATOR.'applicationContext.xml');
        $context = $provider->provide();
        $testService = $context->get('test.service1');
        $this->assertInstanceOf('\Oz\WhiteHowk\Kernel\ContainerProviderTestService', $testService);
    }

    public function testAddMultipleContexts(){
        $provider = new ContainerProvider();
        $provider->addContext(__DIR__.DIRECTORY_SEPARATOR.'applicationContext.xml');
        $provider->addContext(__DIR__.DIRECTORY_SEPARATOR.'applicationContext2.xml');
        $context = $provider->provide();
        $testService = $context->get('test.service2');
        $this->assertInstanceOf('\Oz\WhiteHowk\Kernel\ContainerProviderTestService', $testService);
        $testInstance = $testService->get();
        $this->assertInstanceOf('\Oz\WhiteHowk\Kernel\ContainerProviderTestService', $testInstance);
    }

}
