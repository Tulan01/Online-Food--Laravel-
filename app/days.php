<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class days extends Model
{
     protected $fillable = [
        'days_name','days_name_short', 'days_status'
    ];

}
