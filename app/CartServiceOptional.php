<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartServiceOptional extends Model
{
    public function cart(){
        return $this->belongsTo('App\Cart');
    }
}
