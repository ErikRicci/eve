<?php

namespace Game\Actions\User;

use Game\Repositories\UserRepository;
use Game\Services\User\UserAuthenticationService;
use Game\Services\User\UserService;
use Game\Services\User\UserTokenService;
use R2SSimpleRouter\Response;

class AuthenticateAction
{
    public function __run()
    {
        $user = UserAuthenticationService::authenticate(request('login'), request('password'));
        if (! $user) {
            Response::error(
                message: 'There was an error while trying to authenticate. Maybe login/password is wrong?'
            );
        }

        $token = UserTokenService::generateNewToken();

        Response::success(
            message: 'Logged in successfully',
            data: [
                'token' => $token,
            ],
        );
    }
}