<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Tokens\TokenService;
use APp\Services\Users\UserService;

class JwtMiddleware
{
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $action)
    {
        $authorization = $request->header('Authorization');

        if(! $authorization) {
            //TODO: Poner exeption
        }

        $authExplode = explode(" ", $authorization);

        $token = end($authExplode);

        if(! $token) {
            //TODO: Poner exeption
        }

        $validToken =  $this->tokenService->validateToken($token);

        if(! $validToken) {
            //TODO: Poner exeption
        }



        return $next($request);
    }


}
