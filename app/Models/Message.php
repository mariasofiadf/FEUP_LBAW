<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "message";

    protected $primaryKey = 'msg_id';

    protected $fillable = [
        'msg_content', 
    ];

    public function user(){return $this->hasOne('App\Models\User');}

    public function chat(){return $this->hasOne('App\Models\Chat');}

}
