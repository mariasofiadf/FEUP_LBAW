<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $table = 'user_notification';

    protected $primaryKey = 'notif_id';

    protected $fillable = ["notified_id", "notifier_id",];

    public $timestamps = false;

    protected $casts = [
        'notif_time' => 'datetime',
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function auction(){return $this->belongsTo('App\Models\Auction','auction_id');}

    public function userNotified(){return $this->belongsTo('App\Models\User','notified_id');}

    public function userNotifier(){return $this->belongsTo('App\Models\User','notifier_id');}
    
}