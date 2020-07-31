<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{

	protected $fillable = [
        'cart_id', 'cart_quantity', 'cart_name','cart_price','cart_image','cart_weight','user_id'
    ];
}
