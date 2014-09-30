<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 23.09.14
 * Time: 1:40
 */

namespace Oz\WhiteHowk\Module\Document\Field;


class StringFieldProvider implements DocumentFieldTypeProviderInterface{
    /**
     * Return field type name
     * @return mixed
     */
    public function getName()
    {
        return "string-field";
    }

    public function getEditor()
    {
        return "string-field-editor";
    }

    public function getRenderer()
    {
        return "string-field-renderer";
    }

    /**
     * Serialize field value
     * @param $value
     * @return mixed
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * Deserialize field value
     * @param $value
     * @return mixed
     */
    public function deserialize($value)
    {
        return $value;
    }


} 