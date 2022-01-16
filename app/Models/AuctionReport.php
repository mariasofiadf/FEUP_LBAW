<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "auction_report";

    //protected $primaryKey = ['auction_id', 'user_id',];

    protected $fillable = [
        'description', 'auction_id', 'user_id', 
    ];

    public function user(){return $this->hasOne('App\Models\User');}

    public function auction(){return $this->hasOne('App\Models\Auction');}

}
