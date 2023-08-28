<?php

namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Models\Franchise;
use App\Models\FranchiseTiming;
use App\Repositories\Interfaces\FranchiseRepositoryInterface;
use Carbon\Carbon;

class FranchiseRepository implements FranchiseRepositoryInterface
{
    public function all()
    {
        return Franchise::latest()->get();
    }

    public function get($where = [], $with = [])
    {
        $result = Franchise::active();

        if (!empty($where)) {
            $result->where($where);
        }
        if (!empty($with)) {
            $result->with($with);
        }
        return $result->latest()->get();
    }

    public function FranchiseByCountry($id = [])
    {
        return Country::whereIn('id', $id)->with('franchise')->get();
    }

    public function getFranchiseByCountry($country_id = null, $whereClauses = [], $withClauses = [])
    {
        $query = Franchise::active()->where('country_id', $country_id);
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
        $page = isset($page) ? $page : 10;
        return Franchise::latest()->paginate($page);
    }
    public function store($input)
    {
        $data = [
            'title' => $input['title'],
            'name' => $input['name'],
            'email_address' => $input['email_address'],
            'address' => $input['address'],
            'address2' => $input['address2'],
            'city' => $input['city'],
            'state' => $input['state'],
            'country' => $input['country'],
            'zip_code' => $input['postal_code'],
            'otp_code' => generate_otp(),
            'otp_expire_at' => Carbon::now()->addMinutes(30),
            'status' => 0,
            'telephone' => $input['telephone'],
            'mobile' => $input['mobile'],
            'allow_same_time' => $input['allow_same_time'],
            'delivery_difference_hour' => $input['delivery_difference_hour'],
            'pickup_difference_hour' => $input['pickup_difference_hour'],
            'delivery_option' => $input['delivery_option'],
            'minimum_order_amount' => $input['minimum_order_amount'],
            'minimum_order_amount_later' => $input['minimum_order_amount_later'],
            'off_days' => implode(',', $input['off_days']),
            'status' => $input['status'],

        ];
        $franchise = Franchise::create($data);

        if (isset($input['timing'])) {
            foreach ($input['timing'] as $timing) {

                FranchiseTiming::create([
                    'franchise_id' => $franchise->id,
                    'pickup_limit' => $timing['pickup_limit'],
                    'delivery_limit' => $timing['delivery_limit'],
                    'opening_time' => $timing['opening_time'],
                    'closing_time' => $timing['closing_time'],
                    'status' => 1,

                ]);
            }
        }

        return $franchise;
    }

    public function find($id, $withClauses = [])
    {
        $query = Franchise::where('id', $id);

        if (count($withClauses) > 0) {
            $query->with($withClauses)->pluck('postcode_id');
        }
        return $query->first();
    }

    public function update($input, $id)
    {
        $data = [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => $input['password'],
            'user_password' => $input['password'],
            'country_code' => $input['dial_code'],
            'phone' => $input['full_number'],
            'role_id' => $input['role_id'],
            'address' => $input['address'],
            'address2' => $input['address2'],
            'city' => $input['city'],
            'state' => $input['state'],
            'country' => $input['country'],
            'city' => $input['city'],
            'status' => $input['status'],
        ];
        return Franchise::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Franchise::destroy($id);
    }

    public function forceDelete($id)
    {
        return Franchise::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Franchise::withTrashed()->findOrFail($id)->restore();
    }
}
