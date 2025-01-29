<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = ['selling_price','buying_price', 'fetched_at'];

    protected $casts = [
        'fetched_at' => 'datetime',
    ];
}
