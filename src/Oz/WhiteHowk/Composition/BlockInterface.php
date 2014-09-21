<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 20.09.14
 * Time: 2:47
 */

namespace Oz\WhiteHowk\Composition;
use Symfony\Component\HttpFoundation\Request;


/**
 * Interface BlockInterface specifies block api.
 * Block represents one peace of layout.
 * @package Oz\WhiteHowk\Composition
 */
interface BlockInterface {
    public function setName($name);
    public function getName();

    public function setTemplatePath($path);
    public function getTemplatePath();

    public function render();

    public function setRequest(Request $request);

}