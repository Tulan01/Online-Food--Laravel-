<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
   protected $fillable = [
        'days_id', 'user_id', 'start_date','end_date','subscrip_price','subscrip_status'
    ];

}
