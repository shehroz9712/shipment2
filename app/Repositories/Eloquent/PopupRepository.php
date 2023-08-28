<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\Models\Popup;
use App\Models\PopupUser;
use App\Repositories\Interfaces\PopupRepositoryInterface;
use App\Models\User;

class PopupRepository implements PopupRepositoryInterface
{

    public function all()
    {
        return Popup::latest()->paginate(10);
    }

    public function find($id)
    {
        return Popup::findOrFail($id);
    }

    public function get_users()
    {
        return User::all();
    }

    public function get_packages()
    {
        return Package::all();
    }

    public function get($where = [])
    {
        return Popup::where($where)->latest()->get();
    }

    public function getPopupById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Popup::where('id', $id);

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

    public function getUserPopupById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = PopupUser::where('id', $id);

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
        return Popup::latest()->paginate($page);
    }

    public function store($data)
    {
        $value = [
            'title'     => $data['title'],
            'html_code' => $data['html_code'],
            'type'      => $data['type'],
            'status'    => $data['status'] ?? 0,
        ];
        return Popup::create($value);
    }

    public function update($id, $data)
    {
        $value = [
            'title'     => $data['title'],
            'html_code' => $data['html_code'],
            'type'      => $data['type'],
            'status'    => $data['status'] ?? 0,
        ];
        return $this->find($id)->update($value);
    }

    public function destroy($id)
    {
        return $this->find($id)->destroy($id);
    }

    public function forceDelete($id)
    {
        return $this->find($id)->forceDelete();
    }

    public function recover($id)
    {
        return Popup::withTrashed()->findOrFail($id)->restore();
    }
}
