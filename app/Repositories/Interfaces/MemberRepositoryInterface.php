<?php
namespace App\Repositories\Interfaces;

interface MemberRepositoryInterface
{
    public function all();

    public function getActiveMembers();

    public function get($where);

    public function getUsersByRoles(array $roles);

    public function getUsersById($id, array $whereClauses = [], array $withClauses = []);

    public function getMembersByCountryID($country_id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function destroy($id);

    public function delete($id);

    public function forceDelete($id);

    public function recover($id);
}
