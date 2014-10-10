<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 10.10.14
 * Time: 4:29
 */

namespace Oz\WhiteHowk\Module\Security\Core;


class UserToken {

    /**
     * User token - user name, email, twitter api token etc
     * @var string
     */
    private $token;

    /**
     * Is token authenticated
     * @var boolean
     */
    private $authenticated;

    /**
     * Is user authorized.
     * User is authorized when all authorization steps are completed. Default there are no any steps.
     * Steps should be configured in AuthorizationManager
     * @var boolean
     */
    private $authorized;

    /**
     * Array of errors that takes place during authentication or authorization
     * @var array
     */
    private $errors;

    /**
     * Clears token state
     */
    public function clear(){
        $this->token = false;
        $this->authenticated = false;
        $this->authorized = false;
        $this->errors = array();
    }

    public function addError($error){
        $this->errors[] = $error;
    }



} 