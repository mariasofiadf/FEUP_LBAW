<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionNotification extends Model{
    protected $table = 'auction_notification';

    protected $primaryKey = 'notif_id';

    protected $fillable = ["notified_id", "auction_id",];

    public $timestamps = false;

    protected $casts = [
        'anotif_time' => 'datetime',
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function auction(){return $this->belongsTo('App\Models\Auction','auction_id');}

    public function user(){return $this->belongsTo('App\Models\User','notified_id');}


}