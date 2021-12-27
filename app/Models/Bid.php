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

    public function bidder(){return $this->hasOne('App\Models\User');}

    public function auction(){return $this->hasOne('App\Models\Auction');}

}
