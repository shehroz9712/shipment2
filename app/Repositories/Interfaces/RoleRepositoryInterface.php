<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function all();

    public function getRoles($whereClause);

    public function findById($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);

}
