<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOptionalDescription extends Model
{
    public function serviceOptional()
    {
        return $this->belongsTo('App\ServiceOptional');
    }
}
