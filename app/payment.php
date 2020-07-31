<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'pay_method','pay_status',
}
    