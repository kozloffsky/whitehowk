<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 10.10.14
 * Time: 4:41
 */

namespace Oz\WhiteHowk\Module\Security\Core;


interface AuthorizationStepInterface {
    /**
     * Return true if everything is ok, error object otherwise
     * @param UserToken $token
     * @return mixed
     */
    public function authorize(UserToken $token);
} 