<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::latest()->get();
    }

    public function get($where = [])
    {
        return User::where($where)->latest()->get();
    }

    public function getUsersByRoles(array $roles)
    {
        return User::whereIn('role_id', $roles)->latest()->get();
    }

    public function getUsersById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = User::where('id', $id);

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
        return User::latest()->paginate($page);
    }

    public function store($input)
    {
        $data = [
            ''
        ];
        return User::create($data);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($input, $id)
    {
        $data = [
            ''
        ];
        return User::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function forceDelete($id)
    {
        return User::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return User::withTrashed()->findOrFail($id)->restore();
    }
}
