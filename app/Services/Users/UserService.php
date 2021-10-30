<?php

namespace App\Services\Users;

use App\Interfaces\IUserServiceInterface;
use App\Models\User AS UserModel;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserServiceInterface
{
    public function __construct()
    {

    }

    function getPaginate(array $filter, array $options)
    {
        $pagination = UserModel::pagination($filter, $options);

        return $pagination;
    }


    function getUsers()
    {
        $users = UserModel::all();
        return $users;
    }

    function getUserById(int $id)
    {
        $user = UserModel::find($id);
        return $user;
    }

    function getUserByEmail(string $email)
    {
        $user = UserModel::where("email", $email)->first();
        return $user;
    }

    function createUser(array $createBody)
    {
        $user = UserModel::create($createBody);

        return $user;
    }

    function updateUser(int $id, array $updateBody)
    {
       $user = $this->getUserById($id);

       if(! $user){
           // crear exception
       }

       if(isset($updateBody["password"])) {
            $updateBody["password"] = Hash::make($updateBody["password"]);
       }

       $user->fill($updateBody);

       $user->save();

       $user = $this->getUserById($id);

       return $user;
    }

    function deleteUser(int $id)
    {
        $user = $this->getUserById($id);

        if(! $user) {
            // exception;
        }

        $user->delete();

        return $user;
    }
}
