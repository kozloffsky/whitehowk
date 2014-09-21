<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 20.09.14
 * Time: 16:01
 */

namespace Oz\WhiteHowk\Composition\Loader;


use Propel\Common\Config\XmlToArrayConverter;

class XmlLoaderTest extends \PHPUnit_Framework_TestCase{
    public function testLayoutDefinition(){
        $reader = new \Zend\Config\Reader\Xml();
        $arr = new \Zend\Config\Config($reader->fromString('<?xml version="1.0" ?>
<layout>
    <!-- definition tag define block -->
    <!-- @name|string Name for this block (required)-->
    <!-- @template|string Template path for this block without extension (required)-->
    <!-- @class|string Implementation of this bloc. Must be instance of \Oz\Whitehowk\Composition\BlockInterface
        if nt provided then default block implementation created -->
    <default name="base.layout" template="page/layout" class="\Oz\Whitehowk\Module\Page\Block\Layout">
        <!-- Child blocks-->

            <header name="header" template="page/header" />
            <content name="content" template="page/content" class="\Oz\TestClass" />

    </default>
</layout>'));

        $arr2 = new \Zend\Config\Config($reader->fromString('<?xml version="1.0" ?>
<layout>
    <!-- definition tag define block -->
    <!-- @name|string Name for this block (required)-->
    <!-- @template|string Template path for this block without extension (required)-->
    <!-- @class|string Implementation of this bloc. Must be instance of \Oz\Whitehowk\Composition\BlockInterface
        if nt provided then default block implementation created -->
    <default name="base.layout" template="cms/layout" class="\Oz\Whitehowk\Module\Page\Block\Layout">
        <!-- Child blocks-->
            <footer name="footer" template="page/footer" />
            <content name="content" template="cms/content" />
    </default>

</layout>'));

        $arr->merge($arr2);

        //var_dump($arr->definition->children->definition[2]);

        //$this->assertEquals($arr->definition->children[2]->name ,'content');
    }
} 