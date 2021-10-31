<?php

namespace App\Services\Users;

use App\Interfaces\ICrud;
use App\Services\Users\Traits\UserCrudTrait;

class UserService implements ICrud
{
    use UserCrudTrait;

    public function __construct()
    {

    }

}
