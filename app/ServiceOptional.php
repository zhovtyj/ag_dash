<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOptional extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function serviceOptionalDescriptions()
    {
        return $this->hasMany('App\ServiceOptionalDescription');
    }
}
