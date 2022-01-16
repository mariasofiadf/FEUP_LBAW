<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    public const CATEGORY = ['ArtPiece', 'Book', 'Jewelry', 'Decor', 'Other'];

    public $timestamps = false;

    protected $table = "auction";

    protected $primaryKey = 'auction_id';

    protected $fillable = [
        'title', 'description', 'min_opening_bid', 'min_raise', 'start_date', 'predicted_end', 'close_date', 'status', 'category', 'auction_image', 'seller_id', 'time_increment'
    ];

    protected $guarded = [ 'seller_id'];

    public function owner(){return $this->belongsTo('App\Models\User','seller_id');}

    public function chat(){return $this->hasOne('App\Models\Chat');}

    public function bids(){return $this->hasMany('App\Models\Bid', 'auction_id');}

    public function images(){return $this->hasMany('App\Models\Image');}

    public function notifications(){return $this->hasMany('App\Models\AuctionNotification');}

}


