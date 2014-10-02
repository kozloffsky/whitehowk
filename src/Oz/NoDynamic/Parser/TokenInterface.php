<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 17:46
 */

namespace Oz\NoDynamic\Parser;


interface TokenInterface {
    public function parse($string, $replacementStart, $replacementEnd = '');
} 