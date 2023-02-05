<?php

namespace Game\Controllers;

use Game\Entities\User;
use Game\Services\User\UserService;
use R2SSimpleRouter\Response;

class UserController
{
    public function index()
    {
        Response::success(
            data: UserService::getPaginated()
        );
    }

    public function show(int $userId)
    {
        Response::success(
            data: User::getRepository()->getByIdOrDie($userId)
        );
    }
}