<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/30/14
 * Time: 17:31
 */

namespace Oz\WhiteHowk\Module\Security\Service;


use Oz\WhiteHowk\Module\Page\Controller\Exception\ServiceErrorException;
use Oz\WhiteHowk\Module\Security\Domain\UserEntity;
use Oz\WhiteHowk\Module\Security\Domain\UserEntityQuery;


class UserService {

    public function register($email = '', $password = ''){
        if(! $this->checkEmailAvailability($email)){
            throw new ServiceErrorException(array(array('message'=>'Email already registered')));
        }
        $entity = new UserEntity();
        $entity->setEmail($email);
        $entity->setPassword($password);

        if(!$entity->validate()){
            $errors = array();
            foreach($entity->getValidationFailures() as $failrue){
                $error = array(
                    'message' => $failrue->getMessage(),
                    'type' => 'error'
                );
                array_push($errors, $error);
            }
            throw new ServiceErrorException($errors);
        }

        return $entity->save();
    }

    public function checkEmailAvailability($email){
        $count = UserEntityQuery::create()->findByEmail($email)->count();
        return $count == 0;
    }

}