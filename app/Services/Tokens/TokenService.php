<?php
namespace App\Services\Tokens;

use App\Services\Tokens\Traits\TokenAuthTrait;
use App\Services\Tokens\Traits\TokenCrudTrait;

class TokenService
{
    use TokenCrudTrait, TokenAuthTrait;

    public function __construct()
    {

    }
}
