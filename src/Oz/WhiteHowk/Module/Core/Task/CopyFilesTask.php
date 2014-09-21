<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 21.09.14
 * Time: 22:12
 */

namespace Oz\WhiteHowk\Module\Core\Task;


use Oz\WhiteHowk\Task\TaskInterface;
use Symfony\Component\Filesystem\Filesystem;

class CopyFilesTask implements TaskInterface{
    /**
     * @param array $args
     * @return mixed
     */
    public function run($args = array())
    {
        $originDir = $args['originDir'];
        $targetDir = $args['targetDir'];

        $filesystem = new Filesystem();
        $filesystem->symlink($originDir, $targetDir, true);
    }

} 