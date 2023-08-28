<?php

namespace App\Repositories\Interfaces;

interface PackageRepositoryInterface
{
    public function get();

    public function find($id);

    public function find_package_by_id($id, array $whereClauses = [], array $withClauses = []);

    public function store(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
