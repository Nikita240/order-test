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
        return $this->belongsToMany('App\Product');
    }

    /**
     * Get the total cost for this order
     *
     * @return int Cost of this order in cents
     */
    public function getTotalAttribute()
    {
        return $this->products->sum('cost');
    }
}
