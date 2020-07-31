<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu_item extends Model
{
     protected $fillable = [
        'catagoty_id', 'item_name', 'item_image','item_details','item_price','item_status'
    ];
}
