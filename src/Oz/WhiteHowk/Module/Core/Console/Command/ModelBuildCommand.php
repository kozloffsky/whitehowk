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
use Oz\WhiteHowk\Module\Core\Task\CopyModuleSchemas;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModelBuildCommand extends Command {

    private $task;
    private $copySchemasTask;
    /**
     * @var ModuleResolver
     */
    private $_moduleResolver;

    public function __construct(BuildModelTask $task, CopyModuleSchemas $copyModuleSchemas){
        parent::__construct();
        $this->task = $task;
        $this->copySchemasTask = $copyModuleSchemas;

    }

    protected function configure()
    {
        $this
            ->setName('model:build')
            ->setDescription('Build domain classes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->copySchemasTask->run();
        $this->task->run();
    }
} 