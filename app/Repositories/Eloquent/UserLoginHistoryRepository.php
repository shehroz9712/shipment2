<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\UserLoginHistoryRepositoryInterface;
use App\Models\UserLoginHistory;

class UserLoginHistoryRepository implements UserLoginHistoryRepositoryInterface
{
    public function all()
    {
        return UserLoginHistory::latest()->get();
    }

    public function get($where = [])
    {
        return UserLoginHistory::where($where)->latest()->get();
    }

    public function paginate($page)
    {
        return UserLoginHistory::latest()->paginate($page);
    }
    public function store($data)
    {
        return UserLoginHistory::create($data);
    }

    public function find($id)
    {
        return UserLoginHistory::find($id);
    }

    public function checkExistByUserID($id)
    {
        return UserLoginHistory::where('user_id', $id)->exists();
    }

    public function update($input, $id)
    {
        return UserLoginHistory::where('user_id', $id)->update($input);
    }
    public function checkByUserIDExists($id)
    {
        return UserLoginHistory::where("user_id", $id)->exists();
    }

    public function destroy($id)
    {
        return UserLoginHistory::destroy($id);

    }

    public function deleteByUserID($id)
    {

    }
    public function destroyByUserId($id)
    {
        return UserLoginHistory::where('user_id', $id)->delete();
    }

    public function forceDelete($id)
    {
        return UserLoginHistory::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return UserLoginHistory::withTrashed()->findOrFail($id)->restore();
    }
}