<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 1:10
 */

namespace Oz\WhiteHowk\Module\Core\Task;
use Oz\WhiteHowk\Kernel\ModuleResolver;


/**
 * Task for copy resources from modules folders to web directory
 *
 * Class CopyResources
 * @package Oz\WhiteHowk\Taks
 */
class CopyResources implements TaskInterface{
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    /**
     * @param array $args
     * @return void
     */
    public function run($args = array())
    {

    }
} 