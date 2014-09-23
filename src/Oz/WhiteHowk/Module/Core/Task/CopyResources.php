<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 1:10
 */

namespace Oz\WhiteHowk\Module\Core\Task;
use Oz\WhiteHowk\Kernel\ModuleResolver;
use Oz\WhiteHowk\Task\TaskInterface;
use Symfony\Component\Finder\Finder;


/**
 * Task for copy resources from modules folders to web directory
 *
 * Class CopyResources
 * @package Oz\WhiteHowk\Taks
 */
class CopyResources implements TaskInterface{
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    /**
     * @var CopyFilesTask
     */
    private $_copyFilesTask;

    public function __construct(CopyFilesTask $task, ModuleResolver $resolver){
        $this->_copyFilesTask = $task;
        $this->_moduleResolver = $resolver;
    }

    /**
     * @param array $args
     * @return void
     */
    public function run($args = array())
    {
        $targetDir = getcwd().DIRECTORY_SEPARATOR.'web';

        foreach(Finder::create()
                    ->path('resources')
                    ->files()
                    ->in($this->_moduleResolver->getModulesPathArray()) as $path){
            echo $path->getRealPath()."\n";
        }
    }
} 