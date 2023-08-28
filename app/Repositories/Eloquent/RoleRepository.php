<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
    }

    public function getRoles($whereClause)
    {
        return Role::whereIn('id', $whereClause)->get();
    }

    public function findById($id)
    {
        return Role::findOrFail($id);
    }

    public function store($input)
    {
        $data = [
            'name' => $input['name'],
            'guard_name' => $input['guard_name'],
            'status' => $input['status']
        ];
        return Role::create($data);
    }


    public function update($id, $input)
    {
        $data = [
            'name' => $input['name'],
            'guard_name' => $input['guard_name'],
            'status' => $input['status']
        ];
        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function destroy($id)
    {
        return Role::destroy($id);
    }

    public function forceDelete($id)
    {
        return Role::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Role::withTrashed()->findOrFail($id)->restore();
    }
}
