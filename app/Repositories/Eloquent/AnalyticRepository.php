<?php

namespace App\Repositories\Eloquent;

use App\Models\Analytic;
use App\Repositories\Interfaces\AnalyticRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AnalyticRepository implements AnalyticRepositoryInterface
{

    public function all()
    {
        return Analytic::latest()->paginate(10);
    }

    public function get($where = [])
    {
        return Analytic::where($where)->latest()->get();
    }

    public function find($id)
    {
        return Analytic::findOrFail($id);
    }

    public function getAnalyticById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Analytic::where('id', $id);

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
        return Analytic::latest()->paginate($page);
    }

    public function checkAnalytic($data)
    {
        $analytic = Analytic::where([['ip_address', $data['ip_address']], ['country', $data['country']]])->first();
        if (is_null($analytic)) {
            return $this->store($data);
        }else {
            return $this->update($analytic->id, $analytic);
        }
    }

    public function store($data)
    {
        $value = [
            'ip_address' => $data['ip_address'],
            'country'    => $data['country'],
            'view'       => 1,
            'user_id'    => Auth::user()->id,
        ];
        return Analytic::create($value);
    }

    public function update($id, $data)
    {
        $value = [
            'ip_address' => $data['ip_address'],
            'country'    => $data['country'],
            'view'       => ($data['view'] + 1),
        ];
        $data->update($value);
        return $data;
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
        return Analytic::withTrashed()->findOrFail($id)->restore();
    }
}
