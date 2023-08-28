<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\Repositories\Interfaces\SubscriptionRepositoryInterface;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    public function all()
    {
        return Subscription::latest()->paginate(10);
    }

    public function find($id)
    {
        return Subscription::findOrFail($id);
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
        return Subscription::where($where)->latest()->get();
    }

    public function getSubscriptionById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Subscription::where('id', $id);

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
        return Subscription::latest()->paginate($page);
    }

    public function store($data)
    {
        $value = [
            'user_id'        => $data['user_id'],
            'package_id'     => $data['package_id'],
            'payment_method' => $data['payment_method'],
            'type'           => $data['type'],
            'price'          => $data['price'],
            'vat'            => $data['vat'],
            'total'          => ($data['price'] + $data['vat']),
            'trial_period'   => $data['trial_period'],
            'start_date'     => $data['start_date'],
            'end_date'       => $data['end_date'],
            'confirm'        => $data['confirm'] ?? 0,
            'status'         => $data['status'] ?? 0,
        ];
        $subscription = Subscription::create($value);

        $transaction = [
            'user_id'         => $data['user_id'],
            'package_id'      => $data['package_id'],
            'subscription_id' => $subscription->id,
            'payment_method'  => $subscription->payment_method,
            'total_price'     => $subscription->total,
            // 'tid'             => $data['tid'],
            'tid'             => '123456789',
            'payment_status'  => $data['status'] ?? 0,
        ];
        return Transaction::create($transaction);
    }

    public function update($id, $data)
    {
        $value = [
            'user_id'        => $data['user_id'],
            // 'transaction_id' => $data[''],
            'package_id'     => $data['package_id'],
            'payment_method' => $data['payment_method'],
            'type'           => $data['type'],
            'price'          => $data['price'],
            'vat'            => $data['vat'],
            'total'          => ($data['price'] + $data['vat']),
            'trial_period'   => $data['trial_period'],
            'start_date'     => $data['start_date'],
            'end_date'       => $data['end_date'],
            'confirm'        => $data['confirm'] ?? 0,
            'status'         => $data['status'] ?? 0,
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
        return Subscription::withTrashed()->findOrFail($id)->restore();
    }
}
