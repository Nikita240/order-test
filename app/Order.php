<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The products that are part of this order
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
