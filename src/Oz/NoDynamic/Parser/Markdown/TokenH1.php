<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 18:03
 */

namespace Oz\NoDynamic\Parser\Markdown;


use Oz\NoDynamic\Parser\TokenInterface;

class TokenH1 implements TokenInterface{

    public function parse($string, $replacementStart, $replacementEnd = '\n')
    {
        $regexp = '/^\#{1}\s+?(.+)/m';

        $replacement = $replacementStart.'$1'.$replacementEnd;

        return preg_replace($regexp, $replacement, $string);
    }

} 