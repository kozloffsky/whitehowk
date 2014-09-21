<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 20.09.14
 * Time: 19:02
 */

namespace Oz\WhiteHowk\Composition;


use Symfony\Component\HttpFoundation\Request;

class BlockAbstract implements BlockInterface {

    protected $_name;
    protected $_templatePath;
    protected $_children;
    protected $_request;

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setTemplatePath($path)
    {
        $this->_templatePath = $path;
    }

    public function getTemplatePath()
    {
        return $this->_templatePath;
    }

    public function addChild(BlockInterface $child){
        $this->_children[$child->getName()] = $child;
    }

    public function renderChild($name){
        if(!isset($this->_children[$name])){
            throw new Exception('Bad Child name exception');
        }

        $child = $this->_children[$name];
        return $child->render();
    }

    public function render(){

    }

    public function setRequest(Request $request)
    {
        $this->_request = $request;
    }


} 