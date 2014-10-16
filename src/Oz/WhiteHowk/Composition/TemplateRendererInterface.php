<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/16/14
 * Time: 15:00
 */

namespace Oz\WhiteHowk\Composition;


interface TemplateRendererInterface {
    /**
     * Return template render result
     * @param $template template name
     * @param $data data for template
     * @return string
     */
    public function render($template, $data);
} 