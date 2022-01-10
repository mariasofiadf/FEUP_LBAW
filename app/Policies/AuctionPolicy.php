<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Auction;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
class AuctionPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new auction
      return Auth::check();
    }

    public function delete(User $user, Auction $auction)
    {
      // Only a auction owner can delete it
      return $user->id == $auction->user_id;
    }

    public function bid(Request $request, $id)
    {
      return true;
      return Auth::check() && $id != Auth::user()->user_id;
    }
}
