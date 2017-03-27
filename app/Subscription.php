<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function subscriptionServices()
    {
        return $this->hasMany('App\SubscriptionService');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }
}
