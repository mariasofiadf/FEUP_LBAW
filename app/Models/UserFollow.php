<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Models {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["id_followed", "id_follower"];

    protected $table = 'user_follow';
}