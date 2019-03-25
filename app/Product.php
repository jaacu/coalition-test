<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];

    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->stock;
    }
}
