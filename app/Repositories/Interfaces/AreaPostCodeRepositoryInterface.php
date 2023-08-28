<?php

namespace App\Repositories\Interfaces;

interface AreaPostCodeRepositoryInterface
{
    public function all();

    public function getAreaPostCodesWith($where = [], $with =[]);

    public function getAreaPostCodeWith($id, $where = [], $with =[]);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function delete($id);

    public function recover($id);
}
