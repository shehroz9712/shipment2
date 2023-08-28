<?php

namespace App\Services\Stripe;

use config;
use Stripe\StripeClient;

class PaymentService
{

    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function generate_token(array $data)
    {
        $card = [
            'name' => $data['name'],
            'number' => $data['number'],
            'cvc' => $data['cvc'],
            'exp_month' => $data['exp_month'],
            'exp_year' => $data['exp_year'],
        ];

        $token = $this->stripe->tokens->create(['card' => $card]);
        return $token->id;
    }

    public function charge_amount(string $token, array $attr)
    {
        $attr['source'] = $token;
        $charge = $this->stripe->charges->create($attr);
        return $charge;
    }
}
