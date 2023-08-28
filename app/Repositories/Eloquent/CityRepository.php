<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Support\Facades\Auth;


class CityRepository implements CityRepositoryInterface
{

    public function all()
    {
        return City::latest()->get();
    }

    public function getCitiesWith($where = [], $with =[])
    {
        return City::where($where)->with($with)->get();
    }

    public function getCityWith($id, $where = [], $with =[])
    {
        $result = City::where('id', $id);

        if (!empty($where)) {
            $result->where($where);
        }

        if (!empty($with)) {
            $result->with($with);
        }

        return $result->first();
    }

    public function getCitiessByCountryID($country_id, array $whereClauses = [], array $withClauses = [])
    {
        $query = City::active()->where('country_id', $country_id);

        if (count($whereClauses) > 0) {
            foreach ($whereClauses as $column => $value) {
                $query->where($column, $value);
            }
        }

        if (count($withClauses) > 0) {
            $query->with($withClauses);
        }

        return $query->get();
    }

    public function paginate($page)
    {
        return City::latest()->paginate($page);
    }

    public function find($id)
    {
        return City::find($id);
    }

    public function store($data)
    {
        $value = [
            'name'       => $data['name'],
            'country_id' => $data['country_id'],
            'latitude'   => $data['latitude'],
            'longitude'  => $data['longitude'],
            'timezones'  => $data['timezones'],
            'created_by' => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];
        return City::create($value);
    }

    public function update($data, $id)
    {
        $value = [
            'name'       => $data['name'],
            'country_id' => $data['country_id'],
            'latitude'   => $data['latitude'],
            'longitude'  => $data['longitude'],
            'timezones'  => $data['timezones'],
            'updated_by' => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];

        return $this->find($id)->update($value);
    }

    public function delete($id)
    {
        return City::find($id)->delete();
    }

    public function recover($id)
    {
        return City::withTrashed()->find($id)->restore();
    }
}
