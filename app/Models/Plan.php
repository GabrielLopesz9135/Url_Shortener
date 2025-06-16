<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Plan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'plans';

    protected $fillable = [
        'name', 
        'daily_limit',     
        'price',           
    ];
}
