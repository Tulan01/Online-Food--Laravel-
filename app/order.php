<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
     protected $fillable = [
        'user_id', 'total_amount', 'order_date','order_status',
    ];
}
   