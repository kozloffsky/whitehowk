<?php
/**
 * Created by PhpStorm.
 * User: mikeoz
 * Date: 16.09.14
 * Time: 17:38
 */

namespace Oz\WhiteHowk\Persistence;


class PersistenceProviderTest extends \PHPUnit_Framework_TestCase{

    public function testLoadConfig(){
        $provider = new PersistenceProvider('persistence.xml');
        $provider->initialize();
    }
} 