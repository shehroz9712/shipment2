<?php

namespace App\Repositories\Interfaces;

interface CityRepositoryInterface
{
    public function all();

    public function getCitiesWith($where = [], $with =[]);

    public function getCityWith($id, $where = [], $with =[]);

    public function getCitiessByCountryID($country_id, array $whereClauses = [], array $withClauses = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function delete($id);

    public function recover($id);
}
