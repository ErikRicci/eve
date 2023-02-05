<?php

namespace Game\Controllers;

use Game\Entities\Power;
use R2SSimpleRouter\Response;

class APIController
{
    public function welcome()
    {
        Response::success(
            message: <<<TEXT
            Welcome to EvE, a game made entirely from PHP! To start a new game, you must first create an account on: 
            '/api/users/register'
            TEXT,
        );
    }
}