<?php

namespace App\Repositories\Interfaces;

interface UserLoginHistoryRepositoryInterface
{
    public function all();

    public function get($where);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function checkExistByUserID($id);
    public function checkByUserIDExists($id);

    public function update($data, $id);

    public function destroy($id);

    public function deleteByUserID($id);

    public function destroyByUserId($id);

    public function forceDelete($id);

    public function recover($id);
}