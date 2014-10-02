<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 02.10.14
 * Time: 3:17
 */

namespace Oz\WhiteHowk\Module\Page\Controller\Exception;


class ServiceErrorException extends \Exception{
    /**
     * @var array
     */
    protected $_data;

    function __construct($_data)
    {
        parent::__construct();
        $this->_data = $_data;
    }


    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }


} 