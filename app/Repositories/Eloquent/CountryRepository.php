<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;


class CountryRepository implements CountryRepositoryInterface
{

    public function all()
    {
        return Country::latest()->get();
    }

    public function getCountriesWith($where = [], $with =[])
    {
        return Country::where($where)->with($with)->get();
    }

    public function get($where = [], $with = [])
    {
        $result = Country::latest();

        if (!empty($where)) {
            $result->where($where);
        }

        if (!empty($with)) {
            $result->with($with);
        }

        return $result->get();
    }

    public function getCitiessByCountryID($country_id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Country::active()->where('country_id', $country_id);

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
        return Country::latest()->paginate($page);
    }

    public function find($id)
    {
        return Country::find($id);
    }

    public function store($data)
    {
        $value = [
            'name'            => $data['name'],
            'capital'         => $data['capital'],
            // 'code'            => $data['code'],
            'iso3'            => $data['iso3'],
            'iso2'            => $data['iso2'],
            'numeric_code'    => $data['numeric_code'],
            'phone_code'      => $data['phone_code'],
            'currency'        => $data['currency'],
            'currency_name'   => $data['currency_name'],
            'currency_symbol' => $data['currency_symbol'],
            'tld'             => $data['tld'],
            'native'          => $data['native'],
            'region'          => $data['region'],
            'subregion'       => $data['subregion'],
            'timezones'       => $data['timezones'],
            'translations'    => $data['translations'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude'],
            'emoji'           => $data['emoji'],
            'emojiU'          => $data['emojiU'],
            'flag'            => $data['flag'],
            "created_by"      => Auth::user()->id,
            "status"          => $data['status'] ?? 0,
        ];
        return Country::create($value);
    }

    public function update($data, $id)
    {
        $value = [
            'name'            => $data['name'],
            'capital'         => $data['capital'],
            // 'code'            => $data['code'],
            'iso3'            => $data['iso3'],
            'iso2'            => $data['iso2'],
            'numeric_code'    => $data['numeric_code'],
            'phone_code'      => $data['phone_code'],
            'currency'        => $data['currency'],
            'currency_name'   => $data['currency_name'],
            'currency_symbol' => $data['currency_symbol'],
            'tld'             => $data['tld'],
            'native'          => $data['native'],
            'region'          => $data['region'],
            'subregion'       => $data['subregion'],
            'timezones'       => $data['timezones'],
            'translations'    => $data['translations'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude'],
            'emoji'           => $data['emoji'],
            'emojiU'          => $data['emojiU'],
            'flag'            => $data['flag'],
            "updated_by"      => Auth::user()->id,
            "status"          => $data['status'] ?? 0,
        ];

        return $this->find($id)->update($value);
    }

    public function delete($id)
    {
        return Country::find($id)->delete();
    }

    public function recover($id)
    {
        return Country::withTrashed()->find($id)->restore();
    }
}
