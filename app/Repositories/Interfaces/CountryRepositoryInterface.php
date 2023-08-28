<?php

namespace App\Repositories\Interfaces;

interface CountryRepositoryInterface
{
    public function all();

    public function getCountriesWith($where = [], $with = []);
    public function getCitiessByCountryID($country_id, array $whereClauses = [], array $withClauses = []);

    public function get($where = [], $with = []);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function delete($id);

    public function recover($id);
}
