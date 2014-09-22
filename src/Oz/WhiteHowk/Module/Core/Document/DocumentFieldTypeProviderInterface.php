<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 23.09.14
 * Time: 1:34
 */

namespace Oz\WhiteHowk\Module\Core\Document;


interface DocumentFieldTypeProviderInterface {

    /**
     * Return field type name
     * @return mixed
     */
    public function getName();

    public function getEditor();

    public function getRenderer();

    /**
     * Serialize field value
     * @param $value
     * @return mixed
     */
    public function serialize($value);

    /**
     * Deserialize field value
     * @param $value
     * @return mixed
     */
    public function deserialize($value);

} 