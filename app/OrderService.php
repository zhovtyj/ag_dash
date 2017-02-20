<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function orderServiceOptionals()
    {
        return $this->hasMany('App\OrderServiceOptional');
    }
}
