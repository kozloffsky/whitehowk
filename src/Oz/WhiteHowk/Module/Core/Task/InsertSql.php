<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 23:36
 */

namespace Oz\WhiteHowk\Module\Core\Task;


use Oz\WhiteHowk\Task\TaskInterface;
use Propel\Generator\Config\GeneratorConfigInterface;
use Propel\Generator\Manager\SqlManager;

class InsertSql implements TaskInterface{

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
        $manager = new SqlManager();

        $generatorConfig = $this->_config;

        $connections = $generatorConfig->getBuildConnections();

        $manager->setConnections($connections);
        /*
         $manager->setLoggerClosure(function ($message) use ($input, $output) {
            if ($input->getOption('verbose')) {
                $output->writeln($message);
            }
        });*/
        $manager->setWorkingDirectory($generatorConfig->getSection('paths')['sqlDir']);
        $manager->insertSql();
    }

} 