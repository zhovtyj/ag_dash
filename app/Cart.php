<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function cartServiceOptional()
    {
        return $this->hasMany('App\CartServiceOptional');
    }
}
