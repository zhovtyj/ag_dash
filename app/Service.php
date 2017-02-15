<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function serviceOptionals()
    {
        return $this->hasMany('App\ServiceOptional');
    }
}
