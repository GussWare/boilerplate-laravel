<?php

namespace App\Services\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token as TokenModel;

class AuthService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(string $email, string $password)
    {
        $user = $this->userService->getUserByEmail($email);

        if(! $user) {
            // TODO: Poner un throw error por favor
        }

        $isPasswordMatch = Hash::check($password, $user->password);

        if(! $isPasswordMatch) {
            // TODO: Poner un throw error por favor
        }

        return $user;
    }

    public function logout($token)
    {
        $type = config("jwt.type_refresh");

        $refreshToken  = TokenModel::where('token', $token)-> where('type', $type)->first();

        if(! $refreshToken) {
            // TODO: poner exception
        }

        $refreshToken->delete();
    }
}
