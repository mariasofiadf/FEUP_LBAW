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

    public function auction(){return $this->hasOne('App\Models\Auction','auction_id');}

    public function userNotified(){return $this->hasOne('App\Models\User','notified_id');}

    public function partial()
    {
        switch($this -> notif_category)
        {
            case "Opened":
                $partial_name = "opened";
                break;
            case "Closed":
                $partial_name = "closed";
                break;
            case "New Bid":
                $partial_name = "new_bid";
                break;
            case "New Message":
                $partial_name = "new _message";
                break;
            case "Auction Follow":
                $partial_name = "auction_follow";
                break;
        }

        return view("partial.notifications." . $partial_name, ["auction" => $this->auction]);
    }
}