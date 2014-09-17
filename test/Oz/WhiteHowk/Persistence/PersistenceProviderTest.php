<?php
/**
 * Created by PhpStorm.
 * User: mikeoz
 * Date: 16.09.14
 * Time: 17:38
 */

namespace Oz\WhiteHowk\Persistence;


use Propel\Generator\Config\GeneratorConfig;

class PersistenceProviderTest extends \PHPUnit_Framework_TestCase{

    private $_provider;
    public function setUp(){
        $this->_provider = new PersistenceProvider(new GeneratorConfig('persistence.xml'));
    }
    public function testLoadConfig(){
        $this->_provider->initialize();
    }
} 