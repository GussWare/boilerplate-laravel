<?php
namespace App\Services\Users\Traits;

use App\Models\User AS UserModel;

trait UserCrudTrait {

    public function getPaginate(array $filter, array $options)
    {
        $pagination = UserModel::pagination($filter, $options);

        return $pagination;
    }


    public function getAll()
    {
        $users = UserModel::all();
        return $users;
    }

    public function getById(int $id)
    {
        $user = UserModel::find($id);
        return $user;
    }

    public function getByEmail(string $email)
    {
        $user = UserModel::where("email", $email)->first();
        return $user;
    }

    public function create(array $body)
    {
        $user = UserModel::create($body);

        return $user;
    }

    public function update(int $id, array $body)
    {
       $user = $this->getById($id);

       if(! $user){
           // crear exception
       }

       $user->fill($body);

       $user->save();

       $user = $this->getById($id);

       return $user;
    }

    public function delete(int $id)
    {
        $user = $this->getById($id);

        if(! $user) {
            // exception;
        }

        $user->delete();

        return $user;
    }
}
