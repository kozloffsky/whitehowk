<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 15:32
 */

namespace Oz\NoDynamic\Console\Command;


use Oz\NoDynamic\Parser\Markdown\TokenFactory;
use Oz\NoDynamic\Parser\Parser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Class NewCommand
 *
 * Initializes new project structure template.
 *
 * @package Oz\NoDynamic\Console\Command
 */
class NewCommand extends Command{

    protected function configure(){
        $this->setName('new')
            ->setDescription('Initializes new project structure template.');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $helper = $this->getHelper('question');

        $parser = new Parser();
        $parser->setTokenFactory(new TokenFactory());

        $output->writeln($parser->parseString("# Asdfa sdfa sdf asdf asd\n## adsf asdf asd fasd \n# sdf sd#"));

        $name = $helper->ask($input, $output, new Question('<question>Enter your new site name:</question>'));


    }

} 