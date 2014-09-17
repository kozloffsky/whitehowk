<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 23:39
 */

namespace Oz\WhiteHowk\Console\Command;


use Oz\WhiteHowk\Task\InsertSql;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SqlInsertCommand extends Command {
    private $task;

    public function __construct(InsertSql $task){
        parent::__construct();
        $this->task = $task;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->task->run();
    }

    protected function configure()
    {
        $this
            ->setName('sql:insert')
            ->setDescription('Insert generated SQL');
    }


} 