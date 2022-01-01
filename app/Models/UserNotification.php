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

    public function userNotified()
    {
        return $this -> hasOne(User::class, "notified_id", "user_id");
    }

    public function userNotifier()
    {
        return $this -> hasOne(User::class, "notifier_id", "user_id");
    }

    public function partial()
    {
        switch($this -> notif_category)
        {
            case "Rating":
                $partial_name = "rating";
                break;
            case "Follow":
                $partial_name = "follow";
                break;
        }

        return view("partial.notifications." . $partial_name, ["user" => $this->user]);
    }
}