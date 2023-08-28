<?php

namespace App\Services\Stripe;

use config;
use Stripe\StripeClient;

class PlanService
{

    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function create_plan(array $data, string $images_url = '')
    {
        $stripe_product = $this->stripe->products->create([
            'name' => $data['name'],
            'active' => isset($data['active']) ? $data['active'] : true,
            'description' => isset($data['description']) ? $data['description'] : null,
            // 'images' => [$images_url],
        ]);

        //Set Data for Plan Pricing for Product which created before at top
        $price_data = [
            'unit_amount' => isset($data['unit_amount']) ? $data['unit_amount'] * 100 : 1,
            'currency' => isset($data['currency']) ? $data['currency'] : 'USD',
            'tax_behavior' => isset($data['tax_behavior']) ? $data['tax_behavior'] : 'unspecified',
            'nickname' => isset($data['nickname']) ? $data['nickname'] : null,
            'product' => $stripe_product->id,
        ];
        //Is recurring then set Interval & other attributes
        if (isset($data['recurring']) && $data['recurring'] === 'recurring') {
            //Append Data to pricing_data variable for recurring
            $price_data['recurring'] = ['interval' => isset($data['interval']) ? $data['interval'] : 'day',
                'interval_count' => isset($data['interval_count']) ? $data['interval_count'] : 1,
                'usage_type' => isset($data['usage_type']) ? $data['usage_type'] : 'licensed',
                'trial_period_days' => isset($data['trial_period_days']) ? $data['trial_period_days'] : ''];
        }
        //Create Plan Pricing at Stripe
        $stripe_product['stripe_product_price'] = $this->stripe->prices->create($price_data);
        return $stripe_product;
    }

    public function update_plan(array $data, $stripe_plan)
    {
        $stripe_product_data = [
            'name' => $data['name'],
            'active' => isset($data['active']) ? $data['active'] : true,
            'description' => isset($data['description']) ? $data['description'] : null,
            'images' => isset($data['stripe_images']) ? $data['stripe_images'] : null,
        ];

        $stripe_product = $this->stripe->products->update($stripe_plan->stripe_product_id, $stripe_product_data);
        $this->stripe->plans->delete($stripe_plan->stripe_plan_id,[]);
        //Set Data for Plan Pricing for Product which created before at top
        $price_data = [
            'unit_amount' => isset($data['unit_amount']) ? $data['unit_amount'] * 100 : 1,
            'currency' => isset($data['currency']) ? $data['currency'] : 'USD',
            'tax_behavior' => isset($data['tax_behavior']) ? $data['tax_behavior'] : 'unspecified',
            'nickname' => isset($data['nickname']) ? $data['nickname'] : null,
            'product' => $stripe_product->id,
        ];

        //Is recurring then set Interval & other attributes
        if (isset($data['recurring']) && $data['recurring'] === 'recurring') {
            //Append Data to pricing_data variable for recurring
            $price_data['recurring'] = ['interval' => isset($data['interval']) ? $data['interval'] : 'day',
                'interval_count' => isset($data['interval_count']) ? $data['interval_count'] : 1,
                'usage_type' => isset($data['usage_type']) ? $data['usage_type'] : 'licensed',
                'trial_period_days' => isset($data['trial_period_days']) ? $data['trial_period_days'] : null];
        }
        //Update Plan Pricing at Stripe
        $stripe_product['stripe_product_price'] = $this->stripe->prices->create($price_data);
        return $stripe_product;
    }

    public function charge_amount(string $token, array $attr)
    {
        $attr['source'] = $token;
        $charge = $this->stripe->charges->create($attr);

        return $charge->id;
    }
}
