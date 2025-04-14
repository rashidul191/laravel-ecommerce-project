<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{



    public static function CreateToken($UserEmail, $UserID)
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',   // Issuer (who issued)
            'iat' => time(),            // Issued At (time when the token was issued)
            'exp' => time() + 60 * 60,  // Expiration Time
            'userEmail' => $UserEmail,
            'userID' => $UserID
        ];

        return JWT::encode($payload, $key, 'HS256');
    }


    public static function ReadToken($token)
    {
        try {
            if ($token == null) {
                return 'unauthorized';
            } else {
                $key = env('JWT_KEY');
                return JWT::decode($token, new Key($key, 'HS256'));
            }
        } catch (Exception $e) {
            return 'unauthorized';
        }
    }
}
