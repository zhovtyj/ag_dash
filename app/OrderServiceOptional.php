<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderServiceOptional extends Model
{
    public function orderService()
    {
        return $this->belongsTo('App\OrderService');
    }

    public function serviceOptionalDescription()
    {
        return $this->belongsTo('App\ServiceOptionalDescription');
    }
}
