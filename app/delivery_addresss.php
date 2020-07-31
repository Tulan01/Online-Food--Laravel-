<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivery_addresss extends Model
{
     protected $fillable = [
        'order_id', 'user_id', 'add','add2','city','country','post_code',
    ];
}
