<?php

namespace Game\Actions\User;

use Game\Services\User\UserAuthenticationService;
use R2SSimpleRouter\Response;

class MyAccountAction
{
    public function __run()
    {
        $user = UserAuthenticationService::getUserByJWT(request()->bearerToken());

        Response::success(
            message: vsprintf("User %s is logged in, Erik go to sleep. NOW!", [$user->login] )
        );
    }
}