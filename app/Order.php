<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function orderServices()
    {
        return $this->hasMany('App\OrderService');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }
}
