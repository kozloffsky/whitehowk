<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/15/14
 * Time: 15:38
 */

namespace Oz\WhiteHowk\Composition\Block;


use Oz\WhiteHowk\Composition\BlockAbstract;

class Text extends BlockAbstract{

    private $value;

    public function render(){
        return $this->value;
    }

} 