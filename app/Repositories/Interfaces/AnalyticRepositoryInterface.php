<?php

namespace App\Repositories\Interfaces;

interface AnalyticRepositoryInterface
{
    public function all();

    public function get($where);

    public function find($id);

    public function getAnalyticById($id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function checkAnalytic($data);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
