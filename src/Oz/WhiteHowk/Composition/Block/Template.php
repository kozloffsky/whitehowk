<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/16/14
 * Time: 13:11
 */

namespace Oz\WhiteHowk\Composition\Block;


use Oz\WhiteHowk\Composition\BlockAbstract;
use Oz\WhiteHowk\Composition\TemplateRendererInterface;

class Template extends BlockAbstract {

    private $templateName;
    public function setTemplatePath($path)
    {
        $this->templateName = $path;
        return $this;
    }

    public function getTemplatePath()
    {
        return $this->templateName;
    }

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    public function setTemplateRenderer(TemplateRendererInterface $renderer){
        $this->renderer = $renderer;
    }

    public function render(){
        $data = array();
        foreach ($this->_children as $name=>$block){
            $data[$name] = $block->render();
        }

        $data['block'] = $this;

        return $this->renderer->render($this->getTemplatePath(), $data);
    }

}