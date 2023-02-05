<?php

namespace Game\Services\User;

use Game\DTOs\UserDTO;
use Game\Repositories\UserRepository;
use R2SSimpleRouter\Response;

class UserRegisterService
{
    public static function register(string $login, string $password): bool
    {
        return (bool) UserRepository::create(new UserDTO(login: $login, password: $password));
    }
}