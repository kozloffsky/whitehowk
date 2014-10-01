<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 30.09.14
 * Time: 23:54
 */

namespace Oz\WhiteHowk\Kernel\Aop;


/**
 * Class ProxyGenerator
 * TODO: refactor for using StringBuilder
 * @package Oz\WhiteHowk\Kernel\Aop
 */
class ProxyGenerator
{

    protected $_class;

    protected $_cachePath = __DIR__;

    public function __construct($cachePath = __DIR__)
    {
        $this->_cachePath = $cachePath;
    }

    public function generate($class)
    {
        $this->_class = new \ReflectionClass($class);

        $fileContents = $this->getFileHead() . "\n\n"
            . $this->getProxyClassNamespace() . "\n\n"
            . $this->getProxyClassDefinition() . "\n"
            . $this->getEventDispatcherTrait() . "\n"
            . $this->getMethodWrappers()
            . $this->getFileFoot() . "\n";

        file_put_contents(
            $this->_cachePath . DIRECTORY_SEPARATOR .$this->getProxyPath(),
            $fileContents
        );

        include_once $this->_cachePath . DIRECTORY_SEPARATOR .$this->getProxyPath();

        return $this->getProxyClass();

    }

    public function getFileHead()
    {
        return '<?php';
    }

    public function getProxyClassNamespace()
    {
        $ns = $this->_class->getNamespaceName();
        if(empty($ns)){
            return "";
        }

        return "namespace " . $this->_class->getNamespaceName() . ';';
    }

    public function getProxyClassDefinition()
    {
        $name = $this->_class->getShortName();
        return sprintf("class %sProxy extends %s {", $name, $name);
    }

    public function getEventDispatcherTrait()
    {
        return 'use \Oz\WhiteHowk\Kernel\EventDispatcherAware;';
    }

    public function getMethodWrappers()
    {
        $result = '';
        // get ONLY Public methods
        $methods = $this->_class->getMethods(\ReflectionMethod::IS_PUBLIC);
        /**
         * @var $method \ReflectionMethod
         */
        $hasConstrctor = false;
        foreach ($methods as $method) {
            if($method->isConstructor()){
                $hasConstrctor = true;
            }
            $result .= $this->getMethodWrapper($method) . "\n";
        }

        if(!$hasConstrctor){
            $result .= $this->createEmptyConstructor();
        }

        return $result;
    }

    public function getMethodWrapper(\ReflectionMethod $method)
    {
        if ($method->isStatic() || !$method->isPublic() || $method->getShortName()=='setEventDispatcher' || $method->getShortName()=='getEventDispatcher') {
            return;
        }

        $name = $method->getShortName();
        $argumentNames = $method->getParameters();
        $result = 'public function ' . $name . '(';

        if($method->isConstructor()){
            $result .= '$eventDispatcher';
            if(sizeof($argumentNames)>0){
                $result .= ", ";
            }
        }

        foreach ($argumentNames as $argument) {
            $result .= $this->getArgumentWrapper($argument, sizeof($argumentNames));
        }
        $result .= "){\n";

        if($method->isConstructor()){
            $result .= '$ed = $eventDispatcher;'."\n";
        }else{

            $result .= '$ed = $this->getEventDispatcher();'."\n";
        }

        $result .= '$preEvent = new \Oz\WhiteHowk\Kernel\Aop\MethodPreInvokeEvent(func_get_args(), "' . $method->getName(
            ) . '", $this);' . "\n";

        $result .= '$ed->dispatch(\Oz\WhiteHowk\Kernel\Aop\MethodPreInvokeEvent::PRE_INVOKE_EVENT, $preEvent);' . "\n";

        $result .= 'if($preEvent->isPropagationStopped()){' . "\n";

        $result .= 'throw new \Exception("Method call not allowed");' . "\n";

        $result .= '}' . "\n";

        if(!$method->isConstructor()){
            $result .= '$result = ';
        }else{
            $result .= '$result = null;'."\n";
        }

        $result .= 'parent::' . $method->getShortName() . '(';
        foreach ($argumentNames as $argument) {
            $result .= '$' . $argument->getName();
            if ($argument->getPosition() < sizeof($argumentNames) - 1) {
                $result .= ', ';
            }
        }
        $result .= ');' . "\n";

        $result .= '$postEvent = new \Oz\WhiteHowk\Kernel\Aop\MethodPostInvokeEvent($result, func_get_args(), "'
            . $method->getName() . '", $this);' . "\n";

        $result .= '$ed->dispatch(\Oz\WhiteHowk\Kernel\Aop\MethodPostInvokeEvent::POST_INVOKE_EVENT, $postEvent);' . "\n";

        $result .= '$this->setEventDispatcher($ed);'."\n";

        if(!$method->isConstructor()){
            $result .= 'return $result;'."\n";
        }

        $result .= '}' . "\n";

        return $result;

    }

    public function createEmptyConstructor(){
        return 'public function __construct($eventDispatcher){ $this->setEventDispatcher($eventDispatcher);}';
    }

    public function getArgumentWrapper(\ReflectionParameter $arg, $argsCount)
    {
        $res = '';
        if($arg->getClass()){
            $res.= '\\'.$arg->getClass()->getName().' ';
        }

        $res .= '$' . $arg->getName();


        if ($arg->isOptional()) {
            $default = $arg->getDefaultValue();
            if (is_array($default)) {
                $res .= '= array()';
            } elseif (is_string($default)) {
                $res .= ' = "' . $default . '"';
            } elseif (is_bool($default)) {
                $res .= ' = ' . ($default == true ? "true" : "false");
            } elseif (is_null($default)) {
                $res .= ' = null';
            } else {
                $res .= ' = ' . $default;
            }
        }

        if ($arg->getPosition() < $argsCount - 1) {
            $res .= ', ';
        }

        return $res;
    }

    public function getFileFoot()
    {
        return '}';
    }

    public function getProxyPath()
    {
        $className = $this->_class->getName();

        return str_replace("\\", '_', $className) . 'Proxy.php';
    }

    public function getProxyClass(){
        $className = $this->_class->getName();

        return $className . 'Proxy';
    }

} 