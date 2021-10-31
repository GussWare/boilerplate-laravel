<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Users\UserService;
use App\Services\Users\AuthService;
use App\Services\Tokens\TokenService;
use Kayex\HttpCodes;

class AuthController extends Controller
{
    private $userService;
    private $authService;
    private $tokenService;

    public function __construct(UserService $userService, AuthService $authService, TokenService $tokenService)
    {
        $this->userService  = $userService;
        $this->authService  = $authService;
        $this->tokenService = $tokenService;
    }

    public function register(Request $request)
    {
        $user = $this->userService->create($request->all());

        $response = response(["user" => $user], HttpCodes::HTTP_CREATED);

        return $response;
    }

    public function login(Request $request)
    {
        $params = $request->only(["email", "password"]);

        $user   = $this->authService->login($params["email"], $params["password"]);
        $tokens  = $this->tokenService->generateAuthTokens($user);

        return ["user" => $user, "tokens" => $tokens];
    }

    public function logout(Request $request)
    {
        $refreshToken = $request->only("refreshToken");

        $this->authService->logout($refreshToken);

        $response = response([], HttpCodes::HTTP_NO_CONTENT);

        return $response;
    }
}
