<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 1:28
 */

namespace Oz\WhiteHowk\Kernel\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;

trait ContainerAware {

    /**
     * @var ContainerBuilder
     */
    protected $_container;

    public function setContainer(ContainerBuilder $containerBuilder){
        $this->_container = $containerBuilder;
    }
} 