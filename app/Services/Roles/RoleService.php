<?php
namespace App\Services\Roles;

use App\Interfaces\ICrud;
use App\Services\Roles\Traits\RoleCrudTrait;

class RoleService implements ICrud {

    use RoleCrudTrait;

    public function __construct()
    {

    }

}
