<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 17.09.14
 * Time: 23:05
 */
namespace Oz\WhiteHowk\Module\Core\Task;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

trait FileSystemHelper {
    protected $filesystem = null;
    /**
     * Returns a Filesystem instance.
     *
     * @return Filesystem
     */
    protected function getFilesystem()
    {
        if (null === $this->filesystem) {
            $this->filesystem = new Filesystem();
        }

        return $this->filesystem;
    }

    protected function createDirectory($directory)
    {
        $filesystem = $this->getFilesystem();

        try {
            $filesystem->mkdir($directory);
        } catch (IOException $e) {
            throw new \RuntimeException(sprintf('Unable to write the "%s" directory', $directory), 0, $e);
        }
    }

    /**
     * Find every schema files.
     *
     * @param string|array $directory Path to the input directory
     * @param bool         $recursive Search for file inside the input directory and all subdirectories
     *
     * @return array List of schema files
     */
    protected function getSchemas($directory, $recursive = false)
    {
        $finder = new Finder();
        $finder
            ->name('*schema.xml')
            ->in($directory);
        if (!$recursive) {
            $finder->depth(0);
        }

        return iterator_to_array($finder->files());
    }
} 