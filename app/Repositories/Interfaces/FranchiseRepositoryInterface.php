<?php

namespace App\Repositories\Interfaces;

interface FranchiseRepositoryInterface
{
    public function all();

    public function get($where = [], $with = []);

    public function getFranchiseByCountry($country_id = null, $whereClauses = [], $withClauses = []);

    public function paginate($page);

    public function store($data);

    public function find($id, $withClauses = []);

    public function update($data, $id);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);

    public function FranchiseByCountry($id);
}
