<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/22/14
 * Time: 14:35
 */

namespace Oz\WhiteHowk\Module\Core\Task;


use Oz\WhiteHowk\Task\TaskInterface;
use Propel\Generator\Config\GeneratorConfigInterface;
use Propel\Generator\Manager\ModelManager;

class BuildModelTask implements TaskInterface{
    use FileSystemHelper;

    protected $_config;

    public function __construct(GeneratorConfigInterface $config){
        $this->_config = $config;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function run($args = array())
    {
        $workingDirectory = $args['workingDir'];
        $phpDir = $workingDirectory.DIRECTORY_SEPARATOR.'Domain';
        $schemaDir = $workingDirectory.DIRECTORY_SEPARATOR.'schema';
        if(!is_dir($schemaDir)){
            return;
        }

        $generatorConfig = $this->_config;

        $this->createDirectory($workingDirectory);

        $manager = new ModelManager();
        $manager->setFilesystem($this->getFilesystem());
        $manager->setGeneratorConfig($generatorConfig);
        $manager->setSchemas($this->getSchemas($schemaDir, true));
        $manager->setLoggerClosure(function ($message) {
            echo $message."\n";
        });

        $manager->setWorkingDirectory($phpDir);

        $manager->build();
    }

} 