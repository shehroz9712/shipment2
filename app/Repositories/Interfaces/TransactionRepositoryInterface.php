<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function all();

    public function get($where);

    public function getTransactionById($id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($id, $data);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
