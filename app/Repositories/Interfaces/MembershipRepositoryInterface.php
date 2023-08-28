<?php

namespace App\Repositories\Interfaces;

interface MembershipRepositoryInterface
{
    public function all();

    public function getMemberById($id, array $whereClauses = [], array $withClauses = []);

    public function getMembershipById($id, array $whereClauses = [], array $withClauses = []);

    public function find($id);

    public function store($data);

    public function update($data, $id);

    public function delete($id);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);

}
