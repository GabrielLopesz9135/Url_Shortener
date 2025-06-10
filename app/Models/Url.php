<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Url extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'urls';

    protected $casts = [
        'expire_at' => 'datetime',
        'clicks' => 'integer',   
    ];

    protected $fillable = [
        'original_url',
        'short_code',
        'clicks',
        'created_at',
        'expire_at',
    ];

    public $timestamps = false;
}
