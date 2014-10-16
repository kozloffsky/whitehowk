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
    /**
     * @var BlockInterface[]
     */
    protected $_children;
    protected $_request;

    /**
     * @var BlockInterface
     */
    private $parent;

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function addChild(BlockInterface $child){
        $this->_children[$child->getName()] = $child;
        $child->setParent($this);
        return $this;
    }

    public function setParent(BlockInterface $parent){
        $this->parent = $parent;
        return $this;
    }

    public function renderChild($name){
        if(!isset($this->_children[$name])){
            throw new Exception('Bad Child name exception');
        }

        $child = $this->_children[$name];
        return $child->render();
    }

    public function render(){
        return "";
    }

    public function __toString(){
        return $this->render();
    }

} 