<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
     protected $fillable = [
        'order_id', 'item_id','total_quantity','total_amount',
    ];
}
