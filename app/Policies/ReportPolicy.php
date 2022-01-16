<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Auction;
use App\Models\AuctionReport;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
class AuctionReportPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new auction
      return Auth::check();
    }
}