<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 10.10.14
 * Time: 4:23
 */

namespace Oz\WhiteHowk\Module\Security\Core;


class UserPasswordToken {
    /**
     * User token - user name, email etc
     * @var string
     */
    private $user;

    /**
     * User raw password
     * @var string
     */
    private $password;

    function __construct($password, $user)
    {
        $this->password = $password;
        $this->user = $user;
    }


    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }




} 