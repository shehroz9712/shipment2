<?php

namespace App\Repositories\Interfaces;

interface VoucherRepositoryInterface
{
    public function all();

    public function findById($id);

    public function getVoucherById($id, array $whereClauses = [], array $withClauses = []);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
