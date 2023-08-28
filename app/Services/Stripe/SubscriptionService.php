<?php

namespace App\Services\Stripe;

use config;
use Stripe\StripeClient;

class SubscriptionService
{
    //Stripe variable for set value
    protected $stripe;

    //Stripe Construct for SubscriptionService
    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    //Get All Listing of Subscription against all users
    public function get_all_subscription()
    {
        return $this->stripe->subscriptions->all(['limit' => 3]);
    }

    //creat Subscription
    public function create_subscription(array $data)
    {
        $subscptionData = [
            'customer' => $data['customer']['id'],
            'items' => [
                ['price' => $data['plan']['stripe_plan_id']],
            ],
            //'trial_period_days' => isset($data['plan']['trial_period_days'])??$data['plan']['trial_period_days'],
            //'currency' => $data['plan']['currency'],
        ];
        $stripe_subscription = $this->stripe->subscriptions->create($subscptionData);
        return $stripe_subscription;
    }

    //Subscription update
    public function update_subscription(array $data, string $subscription_id)
    {
        $subscptionData = [
            'customer' => $data['customer']['id'],
            'items' => [
                ['price' => $data['plan']['stripe_plan_id']],
            ],
            //'trial_period_days' => $data['plan']['trial_period_days'],
            'currency' => $data['plan']['currency'],
        ];

        $stripe_subscription = $this->stripe->subscriptions->update($subscription_id, $subscptionData);
        return $stripe_subscription;
    }

    //Cancel Subscription instead of Delete Subscription
    public function cancel_subscription(string $subscription_id)
    {
        $stripe_subscription = $this->stripe->subscriptions->cancel($subscription_id, []);
        return $stripe_subscription;
    }

    //Get Details of Subscription
    public function get_subscription(string $subscription_id)
    {
        $stripe->subscriptions->retrieve($subscription_id, []);
    }
}
