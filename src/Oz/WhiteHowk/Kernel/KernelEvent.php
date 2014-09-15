<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 16.09.14
 * Time: 2:32
 */

namespace Oz\WhiteHowk\Kernel;


use Symfony\Component\EventDispatcher\Event;

class KernelEvent extends Event {

    const BOOT = 'kernel.boot';

} 