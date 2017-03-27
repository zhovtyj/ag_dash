<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionService extends Model
{
    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function subscriptionServiceOptionals()
    {
        return $this->hasMany('App\SubscriptionServiceOptional');
    }
}
