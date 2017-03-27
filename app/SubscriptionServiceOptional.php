<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionServiceOptional extends Model
{
    public function subscriptionService()
    {
        return $this->belongsTo('App\SubscriptionService');
    }

    public function serviceOptionalDescription()
    {
        return $this->belongsTo('App\ServiceOptionalDescription');
    }
}
