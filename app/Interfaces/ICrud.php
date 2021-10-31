<?php
namespace App\Interfaces;

interface ICrud {
    public function getPaginate(array $filter, array $options);
    public function getAll();
    public function getById(int $id);
    public function create(array $body);
    public function update(int $id, array $body);
    public function delete(int $id);
}
