<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 23:13
 */

namespace Oz\WhiteHowk\Module\Core\Console\Command;


use Oz\WhiteHowk\Module\Core\Task\CopyModuleSchemas;
use Oz\WhiteHowk\Module\Core\Task\GenerateSqlFromSchemas;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SqlBuildCommand extends Command {
    private $generateSqlTask;
    private $copySchemasTask;

    public function __construct(GenerateSqlFromSchemas $task, CopyModuleSchemas $copyTask){
        parent::__construct();
        $this->generateSqlTask = $task;
        $this->copySchemasTask = $copyTask;
    }

    protected function configure(){
        parent::configure();
        $this
            ->setName('sql:build')
            ->setDescription('Generate SQL for core and modules');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->copySchemasTask->run();
        $this->generateSqlTask->run();
    }


} 