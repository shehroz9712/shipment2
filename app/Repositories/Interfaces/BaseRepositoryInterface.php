<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{


    public function all();
    public function get($where);
    public function paginate($page);
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function destroy($id);
    public function recover($id);
}
