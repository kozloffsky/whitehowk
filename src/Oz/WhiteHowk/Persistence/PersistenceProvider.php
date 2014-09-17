<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 16.09.14
 * Time: 14:25
 */

namespace Oz\WhiteHowk\Persistence;

use Propel\Common\Config\ConfigurationManager;
use Propel\Generator\Config\GeneratorConfig;
use Propel\Generator\Config\GeneratorConfigInterface;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;


/**
 * Class PersistenceProvider
 * This class configures persistence framework
 * @package Oz\WhiteHowk\Persistence
 */
class PersistenceProvider {

    private $_configurationManager;

    /**
     * Path to configuration file
     * @param $config
     */
    public function __construct(GeneratorConfigInterface $config){
        $this->_configurationManager = $config;
        //var_dump($this->_configurationManager->getConfigProperty('database.connections.prod'));
    }

    public function initialize(){
        $env = 'dev';
        $config = $this->getConnectionConfig($env);
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass($env, $config['adapter']);

        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration($config);
        $serviceContainer->setConnectionManager($env, $manager);
    }

    protected function getConnectionConfig($env = 'dev'){
        return $this->_configurationManager->getConfigProperty('database.connections.'.$env);
    }

} 