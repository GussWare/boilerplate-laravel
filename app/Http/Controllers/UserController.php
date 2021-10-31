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

    public function getAll()
    {
        $users  = $this->userService->getAll();

        $response = response(["users" => $users], HttpCodes::HTTP_OK);

        return $response;
    }

    public function getById(int $id)
    {
        $user = $this->userService->getById($id);

        if($user) {

        }

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function getByEmail(string $email)
    {
        $user = $this->userService->getByEmail($email);

        if($user) {

        }

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function create(Request $request)
    {
        $user = $this->userService->create($request->all());

        $response =  response(["user" => $user], HttpCodes::HTTP_CREATED);

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $user = $this->userService->update($id, $request->all());

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }

    public function delete(int $id)
    {
        $user = $this->userService->delete($id);

        $response = response(["user" => $user], HttpCodes::HTTP_OK);

        return $response;
    }
}
