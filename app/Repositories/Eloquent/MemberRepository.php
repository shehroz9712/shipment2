<?php

namespace App\Repositories\Eloquent;

use App\Models\Member;
use App\Models\MemberAddress;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MemberRepository implements MemberRepositoryInterface
{
    public function all()
    {
        return Member::latest()->get();
    }

    public function getActiveMembers()
    {
        return Member::active()->get();
    }

    public function get($where = [])
    {
        return Member::where($where)->latest()->get();
    }

    public function getUsersByRoles(array $roles)
    {
        return Member::whereIn('role_id', $roles)->latest()->get();
    }

    public function getUsersById($id, array $whereClauses = [], array $withClauses = [])
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

    public function getMembersByCountryID($country_id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Member::active()->where('country_id', $country_id);

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
        return Member::latest()->paginate($page);
    }

    public function store($input)
    {
        $data = [
            'register_from' => $input['register_from'],
            'referral_code' => trim($input['referral_code']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => $input['password'],
            'user_password' => $input['password'],
            'otp_code' => generate_otp(),
            'otp_expire_at' => Carbon::now()->addMinutes(60),
            'otp_attempt' => 0,
            'phone' => $input['full_number'],
            'total_loyalty_points' => $input['total_loyalty_points'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'account_notes' => $input['account_notes'],
            'preference_id' => implode(',', $input['preference_list']),
            'created_by' => Auth::guard('admin')->user()->id,
        ];
        $member = Member::create($data);

        $member_address = [
            'member_id' => $member->id,
            'country_id' => $input['country'],
            'city' => $input['city'],
            'address' => $input['address'],
            'address2' => $input['address2'],
            'postal_code' => $input['postal_code'],
            'is_primary' => isset($input['is_primary']) ? $input['is_primary'] : 0,
            'status' => isset($input['status']) ? $input['status'] : 0,
        ];
        MemberAddress::create($member_address);
        return $member;
    }

    public function find($id)
    {
        return Member::find($id);
    }

    public function update($input, $id)
    {
        $data = [
            'register_from' => $input['register_from'],
            'referral_code' => trim($input['referral_code']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['full_number'],
            'total_loyalty_points' => $input['total_loyalty_points'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'account_notes' => $input['account_notes'],
            'preference_id' => implode(',', $input['preference_list']),
            'updated_by' => Auth::guard('admin')->user()->id,
        ];
        if (isset($input['password'])) {
            $data['password'] = $input['password'];
            $data['user_password'] = $input['password'];
        }

        $member = Member::where('id', $id)->update($data);

        if (isset($input['is_primary']) && $input['is_primary'] != 0) {
            MemberAddress::where('member_id', $id)->update(['is_primary' => 0]);
        }

        $member_address = [
            'member_id' => $id,
            'country_id' => $input['country'],
            'city' => $input['city'],
            'postal_code' => $input['postal_code'],
            'address' => $input['address'],
            'address2' => $input['address2'],
            'is_primary' => isset($input['is_primary']) ? $input['is_primary'] : 0,
            'status' => isset($input['status']) ? $input['status'] : 0,
        ];
        MemberAddress::where('member_id', $id)->where('id', $input['existing_address'])->update($member_address);
        return $member;
    }

    public function destroy($id)
    {
        MemberAddress::where('member_id', $id)->destroy();
        return Member::findOrFail($id)->destroy($id);
    }

    public function delete($id)
    {
        MemberAddress::where('member_id', $id)->delete();
        return Member::findOrFail($id)->delete($id);
    }

    public function forceDelete($id)
    {
        MemberAddress::findOrFail($id)->forceDelete();
        return Member::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        MemberAddress::withTrashed()->findOrFail($id)->restore();
        return Member::withTrashed()->findOrFail($id)->restore();
    }
}
