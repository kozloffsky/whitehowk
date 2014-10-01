<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 30.09.14
 * Time: 23:57
 */

namespace Oz\WhiteHowk\Kernel\Aop;


class ProxyGeneratorTest extends \PHPUnit_Framework_TestCase{

    public function testGenerator(){
        $gen = new ProxyGenerator('Oz\Whitehowk\Kernel\Aop\ProxyGeneratorTest');

        $this->assertEquals($gen->getProxyPath(), 'Oz_WhiteHowk_Kernel_Aop_ProxyGeneratorTestProxy.php');

        $this->assertEquals($gen->getFileHead(), '<?php');
        $this->assertEquals($gen->getProxyClassNamespace(), 'namespace Oz\WhiteHowk\Kernel\Aop;');
        $this->assertEquals($gen->getProxyClassDefinition(), 'class ProxyGeneratorTestProxy extends ProxyGeneratorTest {');
        $this->assertEquals($gen->getEventDispatcherTrait(), 'use \Oz\WhiteHowk\Kernel\EventDispatcherAware;');
        $this->assertEquals($gen->getFileFoot(), '}');

        //$gen->generate();
    }

}