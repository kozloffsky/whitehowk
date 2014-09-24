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
class CopyResources implements TaskInterface {
    use FileSystemHelper;
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

        foreach($this->_moduleResolver->getModulesPathArray() as $path){
            $resPath = $path.DIRECTORY_SEPARATOR.'resources';
            if(!is_dir($resPath)){
                continue;
            }

            foreach(Finder::create()
                ->files()
                ->in($resPath) as $file) {
                echo 'Copying '.$file->getRealPath()."\n\t -> ".$targetDir.str_replace($resPath,'',$file->getRealPath()) . "\n";
                $this->getFilesystem()
                    ->symlink(
                        $file->getRealPath(),
                        $targetDir.str_replace($resPath,'',$file->getRealPath()));

            }
        }


    }
} 