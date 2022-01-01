<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username','password', 'email', 'phone_number', 'profile_image', 'auction_notif', 'user_notif',
    ];

    protected $attributes = [
        'credit' => 0,
        'rating' => 0,
        'blocked' => false,
        'auction_notif' => true,
        'user_notif' => true,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The cards this user owns.
     */
    public function cards() {
      return $this->hasMany('App\Models\Card');
    }
  

    public function bids(){return $this->hasMany('App\Models\Bid');}

    public function ownedAuctions(){return $this->hasMany('App\Models\Auction', 'seller_id');}

    public function followedAuctions(){return $this->hasMany('App\Models\Auction');}
}
