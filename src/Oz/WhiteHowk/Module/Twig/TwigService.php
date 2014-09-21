<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 3:06
 */

namespace Oz\WhiteHowk\Module\Twig;


use Oz\WhiteHowk\Kernel\KernelEvent;
use Oz\WhiteHowk\Kernel\ModuleResolver;

/**
 * Twig configurator
 * Class TwigService
 * @package Oz\WhiteHowk\Module\Twig
 */
class TwigService {

    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    /**
     * @param mixed ModuleResolver
     */
    public function setModuleResolver($moduleResolver)
    {
        $this->_moduleResolver = $moduleResolver;
    }



    public function onPostDispatch(KernelEvent $event) {
        $request = $event->getRequest();

        $loader = new \Twig_Loader_Filesystem();

        array_map(function($path) use ($loader) {
            $viewPath = $path.DIRECTORY_SEPARATOR.'view';
            if(is_dir($viewPath)){
                $loader->addPath($viewPath);
            }
        }, $this->_moduleResolver->getModulesPathArray());

        $event->getResponse()->setContent($event->getResponse()->getContent().'.!!11');
    }

}
