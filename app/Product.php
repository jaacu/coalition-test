<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];

    protected $appends = ['total_price'];

    protected $casts =[
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->stock;
    }
}
