<?php

namespace Game\Services\Commons;

use Game\Exceptions\Commons\JWT\ExpiredJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTException;
use Game\Exceptions\Commons\JWT\InvalidJWTSignatureException;

class JWTService
{
    public static function generateJWT(array $data, string $signature, int $expiresInSeconds = 3600): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(array_merge($data, ['exp' => time() + $expiresInSeconds]));
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $rawSignature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $signature, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($rawSignature));

        return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
    }

    /**
     * @throws ExpiredJWTException|InvalidJWTSignatureException|InvalidJWTException
     */
    public static function unpackJWT(
        string $jwt,
        string $signature
    ): array {
        $tokenParts = explode('.', $jwt);

        if (count($tokenParts) !== 3) {
            throw new InvalidJWTException;
        }

        $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $tokenParts[1])), true);
        $rawSignature = base64_decode(str_replace(['-', '_'], ['+', '/'], $tokenParts[2]));
        $expectedSignature = hash_hmac('sha256', $tokenParts[0] . '.' . $tokenParts[1], $signature, true);

        if (! hash_equals($rawSignature, $expectedSignature)) {
            throw new InvalidJWTSignatureException;
        } elseif (isset($payload['exp']) && $payload['exp'] < time()) {
            throw new ExpiredJWTException;
        }

        return $payload;
    }
}