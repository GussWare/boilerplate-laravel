<?php

namespace App\Interfaces;

interface IUserServiceInterface
{
    function getPaginate(array $filter, array $options);
    function getUsers();
    function getUserById(int $id);
    function getUserByEmail(string $email);
    function createUser(array $createBody);
    function updateUser(int $id, array $updateBody);
    function deleteUser(int $id);
}
