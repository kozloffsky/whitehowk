<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 16:04
 */

namespace Oz\NoDynamic\Generator;


class SiteGenerator {

    private $workingDir;
    private $fileSystem;
    private $layout;
    private $twig;

    /**
     * @return mixed
     */
    public function getFileSystem()
    {
        return $this->fileSystem;
    }

    /**
     * @param mixed $fileSystem
     */
    public function setFileSystem($fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @return mixed
     */
    public function getWorkingDir()
    {
        return $this->workingDir;
    }

    /**
     * @param mixed $workingDir
     */
    public function setWorkingDir($workingDir)
    {
        $this->workingDir = $workingDir;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }


    public function generate(){
        $this->initTwig();
    }

    protected function initTwig(){
        $loader = new \Twig_Loader_Filesystem($this->getWorkingDir().DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.$this->getLayout());
        $this->twig = new \Twig_Environment($loader);
    }

} 