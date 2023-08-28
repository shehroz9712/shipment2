<?php

namespace App\Repositories\Interfaces;

interface DiscountRepositoryInterface
{
    public function all();

    //public function get($where);

    public function get($id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function store($input);

    public function find($id);

    public function update($id, $input);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
