<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionFollow extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["id_followed", "id_follower"];

    protected $table = 'auction_follow';
}