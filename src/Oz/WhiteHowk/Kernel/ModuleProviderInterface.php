<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 2:45
 */

namespace Oz\WhiteHowk\Kernel;


interface ModuleProviderInterface {
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName();

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency();
}