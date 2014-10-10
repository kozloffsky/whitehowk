<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 10.10.14
 * Time: 4:38
 */

namespace Oz\WhiteHowk\Module\Security\Core;


/**
 * Class AuthorizationManager
 * Manages authorization process
 * @package Oz\WhiteHowk\Module\Security\Core
 */
class AuthorizationManager {

    /**
     * Array of authorization steps to apply to UserToken
     * @var AuthorizationStepInterface[]
     */
    private $steps;

    public function addStep(AuthorizationStepInterface $step){
        $this->steps[] = $step;
    }

    public function authorize(UserToken $token){
        foreach($this->steps as $step){
            if($error = $step->authorize($token) !== true){
                $token->addError($error);
                return false;
            }
        }
    }

} 