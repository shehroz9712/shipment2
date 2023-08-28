<?php

namespace App\Repositories\Eloquent;

use App\Models\Discount;
use App\Repositories\Interfaces\DiscountRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DiscountRepository implements DiscountRepositoryInterface
{
    public function all()
    {
        return Discount::latest()->get();
    }

    // public function get($where)
    // {
    //     return Discount::where($where)->latest()->get();
    // }

    public function get($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Discount::where('id', $id);

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
        return Discount::latest()->paginate($page);
    }
    public function store($input)
    {
        $data = [
            'country_id' => $input['country'],
            'code' => $input['code'],
            'worth' => $input['worth'],
            'type' => $input['dtype'],
            'start_date' => $input['start_date'],
            'expire_date' => $input['expire_date'],
            'code_used' => $input['code_used'],
            'member_id' => $input['member_id'],
            'discount_for' => $input['discount_for'],
            'minimum_order_amount' => $input['minimum_order_amount'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'created_by' => Auth::guard('admin')->user()->id,
        ];
        return Discount::create($data);
    }

    public function find($id)
    {
        return Discount::find($id);
    }

    public function update($id, $input)
    {
        $data = [
            'country_id' => $input['country'],
            'code' => $input['code'],
            'worth' => $input['worth'],
            'type' => $input['dtype'],
            'start_date' => $input['start_date'],
            'expire_date' => $input['expire_date'],
            'code_used' => $input['code_used'],
            'member_id' => $input['member_id'],
            'discount_for' => $input['discount_for'],
            'minimum_order_amount' => $input['minimum_order_amount'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];
        return Discount::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Discount::destroy($id);

    }

    public function forceDelete($id)
    {
        return Discount::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Discount::withTrashed()->findOrFail($id)->restore();
    }
}
