<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function serviceOptionals()
    {
        return $this->hasMany('App\ServiceOptional');
    }

    public function serviceSubscription()
    {
        return $this->hasOne('App\ServiceSubscription');
    }
}
