<?php

namespace App\Services\Tokens\Traits;

use App\Models\Token as TokenModel;

trait TokenCrudTrait {

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
}
