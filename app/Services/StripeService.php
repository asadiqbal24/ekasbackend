<?php

namespace App\Services;

use Stripe\StripeClient;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.secret'));
    }

    public function getCustomers()
    {
       $events = $this->stripe->events->all();

        return $events;
    }
}


// charge.succeeded