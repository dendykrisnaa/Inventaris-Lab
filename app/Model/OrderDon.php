<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDon extends Model
{
    //
    protected $fillable = [
        'order_id', 'pro_id', 'pro_name', 'pro_quantity','product_price','sub_total'
    ];
}
