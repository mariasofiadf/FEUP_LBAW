<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "chat";

    protected $primaryKey = 'chat_id';

    public function messages(){return $this->hasMany('App\Models\Message');}

    public function auction(){return $this->hasOne('App\Models\Auction');}

}
