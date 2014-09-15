<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 15.09.14
 * Time: 14:59
 */

namespace Oz\WhiteHowk\Module\Page;


use Oz\WhiteHowk\Kernel\ModuleProviderInterface;

class ModuleProvider implements ModuleProviderInterface{
    /**
     * Return module name in format {$vendor/$name}
     * @return string
     */
    public function getName()
    {
        return 'oz/page';
    }

    /**
     * Return array of module names
     * @return array
     */
    public function getDependency()
    {
        return array(
            'oz/twig'
        );
    }

} 