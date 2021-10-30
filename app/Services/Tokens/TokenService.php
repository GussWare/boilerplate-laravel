<?php

namespace App\Services\Tokens;

use App\Models\User as UserModel;
use App\Models\Token as TokenModel;
use Illuminate\Support\Carbon;
use Firebase\JWT\JWT;

class TokenService
{
    public function __construct()
    {

    }

    public function saveToken(string $token, int $userId, string $expires, string $type, bool $blacklisted = false)
    {
        $token = TokenModel::create([
            "token"         => $token,
            "userId"        => $userId,
            "expires"       => $expires,
            "type"          => $type,
            "blacklisted"   => $blacklisted
        ]);

        return $token;
    }

    public function generateAuthTokens(UserModel $user)
    {
        if(! $user) {
            //TODO: Poner throw exception
        }

        $typeAccess     = config('jwt.type_access');
        $typeRefresh    = config('jwt.type_refresh');

        $accessTokenExpires     = Carbon::now()->addMinutes();
        $refreshTokenExpires    = Carbon::now()->addDays();

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

    /**
     *
     */
    public function generateToken(int $userId, string $expires, string $type)
    {
        $secret = config('jwt.secret');

        $payload = array(
            'sub' => $userId,
            'iat' => Carbon::now(),
            'exp' => $expires,
            'type' => $type
        );

        $token = JWT::encode($payload, $secret);

        return $token;
    }
}
