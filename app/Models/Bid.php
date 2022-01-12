<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "bid";

    protected $primaryKey = 'bid_id';

    protected $fillable = [
        'bid_value'
    ];

    public function bidder(){return $this->belongsTo('App\Models\User', 'bidder_id');}

    public function auction(){return $this->belongsTo('App\Models\Auction', 'auction_id');}

}
