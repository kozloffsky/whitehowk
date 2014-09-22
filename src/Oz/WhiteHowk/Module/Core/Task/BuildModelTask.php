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
        $generatorConfig = $this->_config;

        $this->createDirectory($generatorConfig->getSection('paths')['phpDir']);

        $manager = new ModelManager();
        $manager->setFilesystem($this->getFilesystem());
        $manager->setGeneratorConfig($generatorConfig);
        $manager->setSchemas($this->getSchemas($generatorConfig->getSection('paths')['schemaDir'], true));
        $manager->setLoggerClosure(function ($message) {
            echo $message."\n";
        });
        $manager->setWorkingDirectory($generatorConfig->getSection('paths')['phpDir']);

        $manager->build();
    }

} 