<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\UserLoginDetailActivityRepositoryInterface;
use App\Models\LoginDetailActivity;

class UserLoginDetailActivityRepository implements UserLoginDetailActivityRepositoryInterface
{
    
    public function all()
    {
        return LoginDetailActivity::latest()->get();
    }

    public function get($where = [])
    {
        return LoginDetailActivity::where($where)->latest()->get();
    }

    public function paginate($page)
    {
        return LoginDetailActivity::latest()->paginate($page);
    }
    public function store($data)
    {
        return LoginDetailActivity::create($data);
    }

    public function find($id)
    {
        return LoginDetailActivity::find($id);
    }
    public function checkExistByUserID($id)
    {
        return LoginDetailActivity::where('user_id',$id)->exists();
    }

    public function checkByUserIDExists($id)
    {
        return LoginDetailActivity::where("user_id", $id)->exists();
    }

    public function update($input, $id)
    {
        return LoginDetailActivity::where('user_id', $id)->update($input);
    }

    public function destroy($id)
    {
        return LoginDetailActivity::destroy($id);

    }

    public function destroyByUserId($id)
    {
        return LoginDetailActivity::where('user_id', $id)->delete();
    }

    public function deleteByUserID($id)
    {
        return LoginDetailActivity::where('user_id', $id)->delete();

    }

    public function forceDelete($id)
    {
        return LoginDetailActivity::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return LoginDetailActivity::withTrashed()->findOrFail($id)->restore();
    }
}