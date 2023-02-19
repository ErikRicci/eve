<?php

namespace Game\Services\User;

use Game\DTOs\UserDTO;
use Game\Exceptions\Database\User\DuplicateLoginException;
use Game\Repositories\UserRepository;
use R2SSimpleRouter\Response;

class UserRegisterService
{
    /**
     * @throws DuplicateLoginException
     */
    public static function register(string $login, string $password): void
    {
        $loginAlreadyExists = UserRepository::getByLogin($login);
        if ($loginAlreadyExists) {
            throw new DuplicateLoginException;
        }
        UserRepository::create(new UserDTO(login: $login, password: $password));
    }
}