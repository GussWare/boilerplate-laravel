<?php

namespace App\Services\Roles\Traits;

use App\Models\Role as RoleModel;

trait RoleCrudTrait {

    public function getPaginate(array $filter, array $options)
    {
        $pagination = RoleModel::pagination($filter, $options);

        return $pagination;
    }

    public function getAll()
    {
        $roles = RoleModel::all();
        return $roles;
    }

    public function getById(int $id)
    {
        $roles = RoleModel::find($id);
        return $roles;
    }

    public function create(array $body)
    {
        $role = RoleModel::create($body);
        return $role;
    }

    public function update(int $id, array $body)
    {
        $role = $this->getById($id);

       if(! $role){
           // crear exception
       }

       $role->fill($body);

       $rr = $role->save();

       $role = $this->getById($id);

       return $body;
    }

    public function delete(int $id)
    {
        $role = $this->getById($id);

        if(! $role) {
            // exception;
        }

        $role->delete();

        return $role;
    }
}
