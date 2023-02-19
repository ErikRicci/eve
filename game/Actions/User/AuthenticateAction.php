<?php

namespace Game\Actions\User;

use Game\Exceptions\Database\User\InvalidCredentialsException;
use Game\Services\User\UserAuthenticationService;
use Game\Services\User\UserTokenService;
use R2SSimpleRouter\Response;

class AuthenticateAction
{
    public function __run()
    {
        try {
            $user = UserAuthenticationService::attemptAuthentication(request('login'), request('password'));
            Response::success(
                message: 'Logged in successfully',
                data: [
                    'access_token' => UserTokenService::generateNewToken($user),
                ],
            );
        } catch (InvalidCredentialsException $e) {
            Response::error(
                message: $e->getMessage(),
            );
        }
    }
}