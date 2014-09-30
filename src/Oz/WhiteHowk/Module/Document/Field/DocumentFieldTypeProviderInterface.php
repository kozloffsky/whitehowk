<?php

namespace Oz\WhiteHowk\Module\Document\Field;


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