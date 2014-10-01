<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/30/14
 * Time: 17:31
 */

namespace Oz\WhiteHowk\Module\Security\Service;


use Oz\WhiteHowk\Module\Security\Domain\UserEntity;
use Propel\Runtime\Map\TableMap;

class UserService {

    public function register($email, $password){
        $entity = new UserEntity();
        $entity->setEmail($email);
        $entity->setPassword($password);

        if(!$entity->validate()){
            return $entity->getValidationFailures()->__toString();
        }

        return $entity->save();
    }

} 