<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CartRepository implements CartRepositoryInterface
{
    public function sendMails()
    {
        $carts = $this->all();

        foreach ($carts as  $cart) {
            $date = Carbon::parse($cart->created_at)->diffInHours();

            switch (true) {
                case $date < 1:
                    "Within 1 Hour";
                    break;

                case $date > 1 && $date <= 24:
                    "Default Agaya";
                    break;

                case $date >= 48:
                    "Default Agaya";
                    break;

                default:
                    "Default Agaya";
                    break;
            }
        }

        return $carts;
    }

    public function all()
    {
        return Cart::latest()->get();
    }

    public function getCartsWith($where = [], $with = [])
    {
        return Cart::where($where)->with($with)->get();
    }

    public function getCartWith($id, $where = [], $with = [])
    {
        $result = Cart::where('id', $id);

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
        return Cart::latest()->paginate($page);
    }

    public function find($id)
    {
        return Cart::find($id);
    }

    public function store($data)
    {
        $value = [
            'name'       => $data['name'],
            'country_id' => $data['country_id'],
            'latitude'   => $data['latitude'],
            'longitude'  => $data['longitude'],
            'timezones'  => $data['timezones'],
            'created_by' => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];
        return Cart::create($value);
    }

    public function update($data, $id)
    {
        $value = [
            'name'       => $data['name'],
            'country_id' => $data['country_id'],
            'latitude'   => $data['latitude'],
            'longitude'  => $data['longitude'],
            'timezones'  => $data['timezones'],
            'updated_by' => Auth::user()->id,
            "status"     => $data['status'] ?? 0,
        ];

        return $this->find($id)->update($value);
    }

    public function delete($id)
    {
        return Cart::find($id)->delete();
    }

    public function recover($id)
    {
        return Cart::withTrashed()->find($id)->restore();
    }
}
