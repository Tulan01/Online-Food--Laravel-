<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class days_menu extends Model
{
     protected $fillable = [
        'days_menu_details', 'days_menu_image', 'days_menu_status','days_id','days_menu_price',
    ];
}
