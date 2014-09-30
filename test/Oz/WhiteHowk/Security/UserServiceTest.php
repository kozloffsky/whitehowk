<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/30/14
 * Time: 17:50
 */

namespace Oz\WhiteHowk\Security;


use Oz\WhiteHowk\Module\Security\Service\UserService;

class UserServiceTest extends \PHPUnit_Framework_TestCase{

    public function testRegistration(){
        $s = new UserService();
        $s->registerUser(array('email'=>'kozloffsky@gmail.com','password'=>'asd asdf asdf asd'));
    }

} 