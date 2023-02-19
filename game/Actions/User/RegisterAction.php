<?php

namespace Game\Actions\User;

use Game\Exceptions\Database\User\DuplicateLoginException;
use Game\Services\User\UserRegisterService;
use Gandalf\ValidatorFacade;
use R2SSimpleRouter\Response;

class RegisterAction
{
    public function __run()
    {
        $validator = new ValidatorFacade;
        $requestRules = [
            'login' => 'required|min:8',
            'password' => 'required|min:6'
        ];

        if (! $validator->validate(request()->all(), $requestRules)) {
            Response::error(
                message: 'Invalid payload for route!'
            );
        }

        try {
            UserRegisterService::register(
                request('login'),
                request('password')
            );
        } catch (DuplicateLoginException $e) {
            Response::error(
                message: $e->getMessage(),
            );
        }

        Response::success(
            message: 'Registered successfully',
        );
    }
}