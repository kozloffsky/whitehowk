<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 21:23
 */

namespace Oz\WhiteHowk\Task;
use Propel\Generator\Config\GeneratorConfigInterface;
use Propel\Generator\Manager\SqlManager;


/**
 * Class GenerateSqlFromSchemas
 * @package Oz\WhiteHowk\Taks
 */
class GenerateSqlFromSchemas implements TaskInterface{

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

        $this->createDirectory($generatorConfig->getSection('paths')['sqlDir']);

        $manager = new SqlManager();

        $connections = $generatorConfig->getBuildConnections();

        $manager->setConnections($connections);

        $manager->setValidate(true);
        $manager->setGeneratorConfig($generatorConfig);
        $manager->setSchemas($this->getSchemas($generatorConfig->getSection('paths')['schemaDir'], true));
        //TODO: add logger clojure support later
        /*$manager->setLoggerClosure(function ($message) use ($input, $output) {
            if ($input->getOption('verbose')) {
                $output->writeln($message);
            }
        });*/
        $manager->setWorkingDirectory($generatorConfig->getSection('paths')['sqlDir']);

        /*if ($manager->existSqlMap()) {
            $output->writeln("<info>sqldb.map won't be saved because it already exists. Remove it to generate a new map.</info>");
        }*/

        $manager->buildSql();
    }
} 