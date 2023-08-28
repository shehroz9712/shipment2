<?php

namespace App\Repositories\Eloquent;

use App\Models\Discount;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Package;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MembershipRepository implements MembershipRepositoryInterface
{
    public function all($with = [])
    {
        return Membership::with($with)->latest()->get();
    }

    public function getMembershipById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Membership::where('id', $id);

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

    public function getMemberById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Member::where('id', $id);

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

    public function find($id)
    {
        return Membership::findOrFail($id);
    }

    public function store($data)
    {
        $value = [
            'country_id' => isset($data['country_id']) ? $data['country_id'] : 8,
            'member_id' => $data['member_id'],
            'package_id' => $data['package_id'],
            'card_id' => $data['card_id'],
            //'price' => $data['price'],
            'code' => Str::lower(Auth::user()->first_name) . mt_rand(10000, 99999),
            'status' => $data['status'],
            'payment_method' => "online",
            'payment_intent' => 'Testing',
            'payment_intent_secret' => 'Testing',
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ];
        $membership = Membership::create($value);

        $package = Package::where('id', $data['package_id'])->first();

        $value = [];
        $value = [
            // 'country_id' => $membership['country'],
            'code' => $membership['code'],
            'worth' => $package->worth,
            'type' => 1,
            'start_date' => Carbon::create($data['start_date'])->format('Y-m-d'),
            'expire_date' => Carbon::create($data['end_date'])->format('Y-m-d'),
            'code_used' => 2,
            'member_id' => $membership['member_id'],
            'discount_for' => 1, //Discount
            'minimum_order_amount' => isset($data['minimum_order_amount']) ? $data['minimum_order_amount'] : 25,
            'is_membership' => true,
            'membership_id' => $membership['id'],
            'status' => $data['status'],
            'created_by' => Auth::user()->id,
        ];
        $discount = Discount::create($value);

        $this->find($membership['id'])->update([
            'discount_id' => $discount['id'],
            //'discount_worth' => $discount['worth'],
        ]);
        return $discount;
    }

    public function update($data, $id)
    {

    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function destroy($id)
    {
        return Membership::destroy($id);
    }

    public function forceDelete($id)
    {
        return Membership::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Membership::withTrashed()->findOrFail($id)->restore();
    }
}
