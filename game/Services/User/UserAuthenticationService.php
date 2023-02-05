<?php

namespace Game\Services\User;

use Game\Repositories\UserRepository;

class UserAuthenticationService
{
    public static function authenticate(string $login, string $password): bool
    {
        if (! UserRepository::getByLoginAndPassword($login, $password)) {
            return false;
        } else {
            return true;
        }
    }
}