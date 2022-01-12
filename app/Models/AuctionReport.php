<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "auction_report";

    protected $fillable = [
        'msg_content', 
    ];

    public function user(){return $this->hasOne('App\Models\User');}

    public function auction(){return $this->hasOne('App\Models\Auction');}

}
