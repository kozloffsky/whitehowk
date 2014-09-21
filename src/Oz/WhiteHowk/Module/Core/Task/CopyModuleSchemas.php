<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 21.09.14
 * Time: 22:11
 */

namespace Oz\WhiteHowk\Module\Core\Task;


use Oz\WhiteHowk\Kernel\ModuleResolver;
use Oz\WhiteHowk\Task\TaskInterface;
use Symfony\Component\Finder\Finder;

class CopyModuleSchemas implements TaskInterface{
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    private $_copyFilesTask;

    public function __construct(ModuleResolver $moduleResolver, CopyFilesTask $copyFilesTask){
        $this->_moduleResolver = $moduleResolver;
        $this->_copyFilesTask = $copyFilesTask;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function run($args = array())
    {
        $modules = $this->_moduleResolver->getModulesPathArray();
        $targetDir = getcwd().DIRECTORY_SEPARATOR.'schema';
        $finder = new Finder();
        $finder->files()->in($modules)->path('schema')->name('*.schema.xml');
        foreach($finder as $file){
            $originDir = $file->getRealpath();
            $this->_copyFilesTask->run(array('originDir'=>$originDir, 'targetDir'=>$targetDir.DIRECTORY_SEPARATOR.$file->getFilename()));
        }

    }

} 