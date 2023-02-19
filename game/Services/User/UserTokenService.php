<?php

namespace Game\Services\User;

use Game\Entities\User;
use Game\Exceptions\Commons\JWT\ExpiredJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTSignatureException;
use Game\Services\Commons\JWTService;

class UserTokenService
{
    private const USER_TOKEN_SIGNATURE = 'WHOPPER';

    public static function generateNewToken(User $user): string
    {
        return JWTService::generateJWT(
            [
                'user' => $user->toArray()
            ],
            self::USER_TOKEN_SIGNATURE
        );
    }

    /**
     * @throws ExpiredJWTException
     * @throws InvalidJWTSignatureException
     * @throws InvalidJWTException
     */
    public static function unpackUserFromToken(string $token): array
    {
        return JWTService::unpackJWT($token, self::USER_TOKEN_SIGNATURE)['user'];
    }
}