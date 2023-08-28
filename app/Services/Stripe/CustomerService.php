<?php

namespace App\Services\Stripe;

use config;
use Stripe\StripeClient;

class CustomerService
{
    //Stripe variable
    protected $stripe;
    //Stripe CustomerService Constructor global used in this class for each method
    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    //Get all customer details form Stripe according to limit or not limit
    public function get_all_customer()
    {
        return $this->stripe->customers->all(['limit' => 10]);
    }

    //Create Stripe Customer Data
    public function create_customer($data)
    {
        $customerData = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'shipping' => ["name" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_first_name'] . ' ' . $data['shipping_last_name'] : $data['first_name'] . ' ' . $data['last_name'],
                "phone" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_phone'] : $data['phone'],
                "address" => [
                    "line1" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_line1'] : $data['line1'],
                    "line2" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_line2'] : $data['line2'],
                    //"city" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_city'] : $data['city'],
                    "state" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_state'] : $data['state'],
                    "country" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_country'] : $data['country'],
                    "postal_code" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_postal_code'] : $data['postal_code'],
                ],
            ],
            'address' => [
                'line1' => $data['line1'],
                'line2' => $data['line2'],
                //'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
            ],
            'payment_method' => $data['payment_method'],
            'invoice_settings' => ['default_payment_method' => $data['payment_method']],
        ];
        $stripe_customer = $this->stripe->customers->create($customerData);
        return $stripe_customer;
    }

    //Update Stripe Customer Data against customer_id
    public function update_customer(array $data, string $customer_id)
    {
        $customerData = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'shipping' => ["name" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_first_name'] . ' ' . $data['shipping_last_name'] : $data['first_name'] . ' ' . $data['last_name'],
                "phone" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_phone'] : $data['phone'],
                "address" => [
                    "line1" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_line1'] : $data['line1'],
                    "line2" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_line2'] : $data['line2'],
                    "city" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_city'] : $data['city'],
                    "state" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_state'] : $data['state'],
                    "country" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_country'] : $data['country'],
                    "postal_code" => (!isset($data['is_same']) && $data['is_same'] != true) ? $data['shipping_postal_code'] : $data['postal_code'],
                ],
            ],
            'address' => [
                'line1' => $data['line1'],
                'line2' => $data['line2'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
            ],
        ];
        $stripe_customer = $this->stripe->customers->update($customer_id, $customerData);
        return $stripe_customer;
    }

    //Delete Stripe customer against ID
    public function delete_customer(string $customer_id)
    {
        return $this->stripe->customers->delete($customer_id, []);
    }

    //Get details for Stripe customer against customerID
    public function get_customer($customer_id)
    {
        return $this->stripe->customers->retrieve($customer_id, []);
    }
}
