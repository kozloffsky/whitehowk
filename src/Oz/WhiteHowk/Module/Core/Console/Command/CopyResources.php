<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/23/14
 * Time: 16:46
 */

namespace Oz\WhiteHowk\Module\Core\Console\Command;


use Symfony\Component\Console\Command\Command;
use \Oz\WhiteHowk\Module\Core\Task\CopyResources as Task;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CopyResources extends Command{
    private $_task;

    public function __construct(Task $task){
        parent::__construct();
        $this->_task = $task;
    }

    protected function configure(){
        parent::configure();
        $this
            ->setName('resources:copy')
            ->setDescription('Copy modules resources into web folder');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_task->run();
    }
} 