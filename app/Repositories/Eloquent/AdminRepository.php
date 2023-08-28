<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use Carbon\Carbon;

class AdminRepository implements AdminRepositoryInterface
{

    public function all()
    {
        return Admin::latest()->paginate(10);
    }

    public function get($where = [])
    {
        return Admin::where($where)->latest()->get();
    }

    public function getUsersByRoles(array $roles)
    {
        return Admin::whereIn('role_id', $roles)->latest()->get();
    }

    public function getUsersById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Admin::where('id', $id);

        if (count($whereClauses) > 0) {
            foreach ($whereClauses as $column => $value) {
                $query->where($column, $value);
            }
        }

        if (count($withClauses) > 0) {
            $query->with($withClauses);
        }

        return $query->first();
    }

    public function paginate($page)
    {
        return Admin::latest()->paginate($page);
    }
    public function store($input)
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
            'zip_code' => $input['postal_code'],
            'otp_code' => generate_otp(),
            'otp_expire_at' => Carbon::now()->addMinutes(30),
            'status' => isset($input['status']) ? $input['status'] : 0,
        ];
        return Admin::create($data);
    }

    public function find($id)
    {
        return Admin::find($id);
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
            'zip_code' => $input['postal_code'],
            'otp_code' => generate_otp(),
            'otp_expire_at' => Carbon::now()->addMinutes(30),
            'status' => isset($input['status']) ? $input['status'] : 0,
        ];
        return Admin::where('id', $id)->update($data);

    }

    public function updateLoginHistory($input, $id)
    {
        return Admin::where('id', $id)->update($input);
    }

    public function updateUserLoginHistory($data, $id)
    {
        return Admin::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Admin::destroy($id);
    }

    public function forceDelete($id)
    {
        return Admin::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Admin::withTrashed()->findOrFail($id)->restore();
    }
}
