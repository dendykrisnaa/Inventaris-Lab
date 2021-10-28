<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    //
    protected $fillable = [
        'order_id','product_name','jumlah_order','keterangan'
    ];
}
