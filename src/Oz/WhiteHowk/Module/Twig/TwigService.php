<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 18.09.14
 * Time: 3:06
 */

namespace Oz\WhiteHowk\Module\Twig;


use Oz\WhiteHowk\Kernel\KernelEvent;

/**
 * Twig configurator
 * Class TwigService
 * @package Oz\WhiteHowk\Module\Twig
 */
class TwigService {

    public function onPostDispatch(KernelEvent $event){
        $event->getResponse()->setContent($event->getResponse()->getContent().'');

    }

}
