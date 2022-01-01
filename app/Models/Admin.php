<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "admin";

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_name', 'username', 'admin_password', 'email',
    ];

    protected $hidden = [
        'admin_password',
    ];

}
