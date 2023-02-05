<?php

namespace Game\Services\User;

use Game\Repositories\UserRepository;

class UserService
{
    public static function getPaginated(int $perPage = 10)
    {
        return (new UserRepository())->getAllPaginated($perPage);
    }
}