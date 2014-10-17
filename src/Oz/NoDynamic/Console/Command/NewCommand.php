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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class NewCommand
 *
 * Initializes new project structure template.
 *
 * @package Oz\NoDynamic\Console\Command
 */
class NewCommand extends Command{

    private $resourcesRoot;
    private $fileSystem;

    public function setResourcesRoot($resourcesRoot){
        $this->resourcesRoot = $resourcesRoot;
    }

    protected function configure(){
        $this->setName('new')
            ->setDescription('Initializes new project structure template.');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $helper = $this->getHelper('question');

        $siteName = $helper->ask($input, $output, new Question('<question>Enter your new site name: </question>'));

        $this->copyResources();
    }

    protected function copyResources(){
        $this->fileSystem = new Filesystem();
        $finder = new Finder();
        foreach($finder->in($this->resourcesRoot)->files() as $file){
            $relativePath =  str_replace(realpath($this->resourcesRoot).'/site/','',$file->getRealPath());
            $newPath = getcwd().DIRECTORY_SEPARATOR.$relativePath;
            $this->fileSystem->copy($file->getRealPath(), $newPath);
        }
    }

} 