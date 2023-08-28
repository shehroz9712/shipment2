<?php

namespace App\Repositories\Interfaces;

interface PopupRepositoryInterface
{
    public function all();

    public function get($where);

    public function getPopupById($id, array $whereClauses = [], array $withClauses = []);

    public function getUserPopupById($id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function get_users();

    public function get_packages();

    public function update($id, $data);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
