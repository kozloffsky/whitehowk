<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 2:03
 */

namespace Oz\WhiteHowk\Task;


/**
 * Interface TaskInterface
 * @package Oz\WhiteHowk\Taks
 */
interface TaskInterface {
    /**
     * @param array $args
     * @return mixed
     */
    public function run($args = array());
} 