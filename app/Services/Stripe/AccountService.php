<?php

namespace App\Services\Stripe;

use config;
use Stripe\StripeClient;

class AccountService
{

    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function create_account(array $request)
    {
        $shipping_data = ["address" => [
            "line1" => ($request->is_same != true) ? $request->shipping_line1 : $request->line1,
            "line2" => ($request->is_same != true) ? $request->shipping_line2 : $request->line2,
            "city" => ($request->is_same != true) ? $request->shipping_city : $request->city,
            "state" => ($request->is_same != true) ? $request->shipping_state : $request->state,
            "country" => ($request->is_same != true) ? $request->shipping_country : $request->country,
            "postal_code" => ($request->is_same != true) ? $request->shipping_postal_code : $request->postal_code,
        ],
            "name" => $request->first_name . ' ' . $request->last_name,
            "phone" => ($request->is_same != true) ? $request->shipping_phone : $request->phone,
        ];

        $customerArray = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'shipping' => $shipping_data,
            'address' => [
                'line1' => $request->line1,
                'line2' => $request->line2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ],
        ];
        $stripe_customer = $this->stripe->customers->create($customerArray);
        return $stripe_customer->id;
    }
}
