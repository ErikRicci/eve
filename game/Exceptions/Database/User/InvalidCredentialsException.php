<?php

namespace Game\Exceptions\Database\User;

class InvalidCredentialsException extends \Exception
{
    protected $message = 'Login and/or password is invalid';
}