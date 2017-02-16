<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart');
    }
}
