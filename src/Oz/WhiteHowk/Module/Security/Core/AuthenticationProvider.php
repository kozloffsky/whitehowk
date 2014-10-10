<?php
/**
 * Created by PhpStorm.
 * User: miho
 * Date: 10.10.14
 * Time: 4:27
 */

namespace Oz\WhiteHowk\Module\Security\Core;


interface AuthenticationProvider {
    /**
     * Authenticate user.
     * Return UserToken. If success then mark token as authenticated
     * @param UserPasswordToken $userPasswordToken
     * @return UserToken
     */
    public function authenticate(UserPasswordToken $userPasswordToken);

    /**
     * Check UserTokenStorage is there active token for current session token
     * @param $sessionToken session token
     * @return UserToken
     */
    public function getUserToken($sessionToken);

    public function setStorage(UserTokenStorageInterface $storage);
} 