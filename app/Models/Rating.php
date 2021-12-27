<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "rate_value", "id_rated", "id_rates" //"rate_date"
    ];

    public $incrementing = false;

    protected $table = 'rating';

    protected $casts = ['time' => 'datetime'];

    protected $dateFormat = 'Y-m-d H:i:sO';
}