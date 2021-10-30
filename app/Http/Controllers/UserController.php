<?php

namespace App\Http\Controllers;

use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Kayex\HttpCodes;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getPaginate(Request $request)
    {
        $filter     = $request->only(["name", "surname", "email"]);
        $options    = $request->only(["page", "limit", "sortBy"]);

        $result     = $this->userService->getPaginate($filter, $options);

        return $result;
    }

    public function getUsers()
    {
        $users  = $this->userService->getUsers();

        $response = response(["users" => $users], HttpCodes::HTTP_OK);

        return $response;
    }

    public function getUserById(int $id)
    {
        $user = $this->userService->getUserById($id);

        if($user) {

        }

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function getUserByEmail(string $email)
    {
        $user = $this->userService->getUserByEmail($email);

        if($user) {

        }

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function createUser(Request $request)
    {
        $user = $this->userService->createUser($request->all());

        $response =  response(["user" => $user], HttpCodes::HTTP_CREATED);

        return $response;
    }

    public function updateUser(int $id, Request $request)
    {
        $user = $this->userService->updateUser($id, $request->all());

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function deleteUser(int $id)
    {
        $user = $this->userService->deleteUser($id);

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }
}
