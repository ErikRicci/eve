<?php

namespace Game\Services\User;

use Game\Entities\User;
use Game\Exceptions\Commons\JWT\ExpiredJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTSignatureException;
use Game\Exceptions\Database\User\InvalidCredentialsException;
use Game\Repositories\UserRepository;

class UserAuthenticationService
{
    /**
     * @throws InvalidCredentialsException
     */
    public static function attemptAuthentication(string $login, string $password): User
    {
        if (! $user = UserRepository::getByLoginAndPassword($login, $password)) {
            throw new InvalidCredentialsException;
        }

        return User::fromArray($user);
    }

    /**
     * @throws ExpiredJWTException
     * @throws InvalidJWTSignatureException
     * @throws InvalidJWTException
     */
    public static function getUserByJWT(string $token): User
    {
        $tokenUser = UserTokenService::unpackUserFromToken($token);
        return User::fromArray(
            [
                'id' => $tokenUser['id'],
                'login' => $tokenUser['login'],
                'created_at' => $tokenUser['created_at'],
            ]
        );
    }
}