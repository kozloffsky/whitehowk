<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/1/14
 * Time: 22:06
 */

namespace Oz\NoDynamic\Console;


class Application extends \Symfony\Component\Console\Application{

    public function __construct(){
        parent::__construct('NoDynamic');
    }

} 