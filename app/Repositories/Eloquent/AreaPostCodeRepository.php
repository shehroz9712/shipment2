<?php

namespace App\Repositories\Eloquent;

use App\Models\AreaPostCode;
use App\Repositories\Interfaces\AreaPostCodeRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class AreaPostCodeRepository implements AreaPostCodeRepositoryInterface
{

    public function all()
    {
        return AreaPostCode::latest()->get();
    }

    public function getAreaPostCodesWith($where = [], $with =[])
    {
        return AreaPostCode::where($where)->with($with)->get();
    }

    public function getAreaPostCodeWith($id, $where = [], $with =[])
    {
        $result = AreaPostCode::where('id', $id);

        if (!empty($where)) {
            $result->where($where);
        }

        if (!empty($with)) {
            $result->with($with);
        }

        return $result->first();
    }

    public function paginate($page)
    {
        return AreaPostCode::latest()->paginate($page);
    }

    public function find($id)
    {
        return AreaPostCode::find($id);
    }

    public function store($data)
    {
        $value = [
            'code'       => $data['code'],
            'city_id'    => $data['city_id'],
            "created_by" => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];
        return AreaPostCode::create($value);
    }

    public function update($data, $id)
    {
        $value = [
            'code'       => $data['code'],
            'city_id'    => $data['city_id'],
            "updated_by" => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];

        return $this->find($id)->update($value);
    }

    public function delete($id)
    {
        return AreaPostCode::find($id)->delete();
    }

    public function recover($id)
    {
        return AreaPostCode::withTrashed()->find($id)->restore();
    }
}
