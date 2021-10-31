<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Roles\RoleService;
use Kayex\HttpCodes;

class RolesController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getPaginate(Request $request)
    {
        $filter     = $request->only(["name", "surname", "email"]);
        $options    = $request->only(["page", "limit", "sortBy"]);

        $result     = $this->roleService->getPaginate($filter, $options);

        return $result;
    }

    public function getAll()
    {
        $roles  = $this->roleService->getAll();

        $response = response(["roles" => $roles], HttpCodes::HTTP_OK);

        return $response;
    }

    public function getById(int $id)
    {
        $role = $this->roleService->getById($id);

        if($role) {

        }

        $response = response(["role" => $role], HttpCodes::HTTP_OK);

        return $response;
    }

    public function create(Request $request)
    {
        $role = $this->roleService->create($request->all());

        $response =  response(["role" => $role], HttpCodes::HTTP_CREATED);

        return $response;
    }

    public function update(Request $request, $id)
    {
        $body = $request->input();

        $response = response($body, HttpCodes::HTTP_OK);

        return $response;
    }

    public function delete(int $id)
    {
        $role = $this->roleService->delete($id);

        $response = response(["role" => $role], HttpCodes::HTTP_OK);

        return $response;
    }
}
