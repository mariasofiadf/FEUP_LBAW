<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bid;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BidPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Bid $bid)
    {
      // Any user can view a bid
      return true;
    }

    public function list(User $user)
    {
      // Any user can list bids
      return true;
    }

    public function create(User $user)
    {
      // Any user can create a new bid
      return Auth::check();
    }

    public function delete(User $user, Bid $bid)
    {
      // Only a auction owner can delete it
      return false;
    }
}
