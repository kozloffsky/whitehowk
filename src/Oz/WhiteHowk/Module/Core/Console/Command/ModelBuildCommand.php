<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/22/14
 * Time: 14:45
 */

namespace Oz\WhiteHowk\Module\Core\Console\Command;


use Oz\WhiteHowk\Kernel\ModuleResolver;
use Oz\WhiteHowk\Module\Core\Task\BuildModelTask;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModelBuildCommand extends Command {

    private $task;
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    public function __construct(BuildModelTask $task, ModuleResolver $moduleResolver){
        parent::__construct();
        $this->task = $task;
        $this->_moduleResolver = $moduleResolver;
    }

    protected function configure()
    {
        $this
            ->setName('model:build')
            ->setDescription('Build domain classes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach($this->_moduleResolver->getModulesPathArray() as $path){
            $this->task->run(array('workingDir'=>$path));
        }
    }
} 