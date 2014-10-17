<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 02.10.14
 * Time: 1:09
 */

namespace Oz\NoDynamic\Console\Command;


use Oz\NoDynamic\Generator\SiteGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command{

    private $generator;

    /**
     * @return SiteGenerator
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * @param SiteGenerator $generator
     */
    public function setGenerator(SiteGenerator $generator)
    {
        $this->generator = $generator;
    }



    protected function configure(){
        $this->setName('build')
            ->setDescription('Build html');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $this->generator->generate();
    }

}