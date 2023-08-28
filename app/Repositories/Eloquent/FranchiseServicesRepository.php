<?php

namespace App\Repositories\Eloquent;

use App\Models\FranchiseService;
use App\Repositories\Interfaces\FranchiseServicesRepositoryInterface;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class FranchiseServicesRepository implements FranchiseServicesRepositoryInterface
{

    public function store($data)
    {
    }


    public function all()
    {
        return FranchiseService::latest()->get();
    }

    public function get($where = [], $with = [])
    {
        $result = FranchiseService::active();

        if (!empty($where)) {
            $result->where($where);
        }
        if (!empty($with)) {
            $result->with($with);
        }
        return $result->latest()->get();
    }

    public function paginate($page)
    {
        return FranchiseService::latest()->paginate($page);
    }

    public function find($id)
    {
        return FranchiseService::find($id);
    }
    
    public function update($data, $id)
    {
    }

    public function destroy($id)
    {
        return FranchiseService::destroy($id);
    }

    public function forceDelete($id)
    {
        return FranchiseService::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return FranchiseService::withTrashed()->findOrFail($id)->restore();
    }
}
