<?php

namespace Game\Actions\User;

use Game\Services\User\UserRegisterService;
use Game\Services\User\UserTokenService;
use R2SSimpleRouter\Response;

class RegisterAction
{
    public function __run()
    {
        $user = UserRegisterService::register(request('login'), request('password'));
        if (! $user) {
            Response::error(
                message: 'There was an error while trying to create your account.'
            );
        }

        $token = UserTokenService::generateNewToken();

        Response::success(
            message: 'Logged in successfully',
            data: [
                'token' => $token
            ],
        );
    }
}