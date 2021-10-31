<?php
namespace App\Services\Tokens\Traits;

use App\Models\User as UserModel;
use Illuminate\Support\Carbon;
use Firebase\JWT\JWT;

trait TokenAuthTrait {

    public function generateAuthTokens(UserModel $user)
    {
        if(! $user) {
            //TODO: Poner throw exception
        }

        $typeAccess             = config('jwt.type_access');
        $typeRefresh            = config('jwt.type_refresh');

        $accessMinutos          = config('jwt.access_expiration_minutes');
        $resfreshMinutos        = config('refresh_expiration_minutes');

        $accessTokenExpires     = (int) time() + (60 * 60);
        $refreshTokenExpires    = (int) time() + (60 * 60);

        $accessToken            = $this->generateToken($user->id, $accessTokenExpires, $typeAccess);
        $refreshToken           = $this->generateToken($user->id, $refreshTokenExpires, $typeRefresh);

       $this->saveToken($refreshToken, $user->id, $refreshTokenExpires, $typeRefresh);

        return [
                "access" => [
                    "token"     => $accessToken,
                    "expires"   => $accessTokenExpires
                ],
                "refresh" => [
                    "token"     => $refreshToken,
                    "expires"   => $refreshTokenExpires
                ]
            ];
    }

    public function generateToken(int $userId, int $expires, string $type)
    {
        $secret = config('jwt.secret');

        $payload = array(
            'sub' => $userId,
            'iat' => time(),
            'exp' =>  $expires,
            'type' => $type
        );

       $token = JWT::encode($payload, $secret, 'HS256');

        return $token;
    }

    public function decodeToken($token)
    {
        $secret = config("jwt.secret");

        $payload = JWT::decode($token, $secret, array('HS256'));

        return $payload;
    }

    public function validateToken(string $token)
    {
        $valid = false;

        try {
            $payload = $this->decodeToken($token);
            $valid = ($payload["sub"] > 0) ? true : false;
        } catch (\Throwable $th) {
        }

        return $valid;
    }
}
