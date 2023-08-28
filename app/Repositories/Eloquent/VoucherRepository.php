<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class VoucherRepository implements VoucherRepositoryInterface
{
    public function all()
    {
        return Voucher::all();

    }

    public function findById($id)
    {
        return Voucher::findOrFail($id);
    }

    public function getVoucherById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Voucher::where('id', $id);

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

    public function create(array $data)
    {
        $value = [
            'admin_id'    => Auth::guard('admin')->user()->id,
            'voucher'     => $data['voucher'],
            'code'        => str()->slug($data['code']),
            'value'       => $data['value'],
            'unit'        => $data['unit'],
            'expiry'      => $data['expiry'],
            'no_of_users' => $data['no_of_users'],
            'status'      => $data['status'],
        ];
        return Voucher::create($value);
    }

    public function update($id, array $data)
    {
        $value = [
            'admin_id'    => Auth::guard('admin')->user()->id,
            'voucher'     => $data['voucher'],
            'code'        => str()->slug($data['code']),
            'value'       => $data['value'],
            'unit'        => $data['unit'],
            'expiry'      => $data['expiry'],
            'no_of_users' => $data['no_of_users'],
            'status'      => $data['status'],
        ];
        return $this->findById($id)->update($value);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
