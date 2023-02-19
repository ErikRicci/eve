<?php

namespace Game\Exceptions\Database\User;

class DuplicateLoginException extends \Exception
{
    protected $message = 'Login already exists in the database';
}