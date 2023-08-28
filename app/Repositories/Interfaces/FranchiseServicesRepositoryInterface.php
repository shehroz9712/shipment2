<?php

namespace App\Repositories\Interfaces;

interface FranchiseServicesRepositoryInterface
{
    public function all();

    public function get($where = [], $with = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
