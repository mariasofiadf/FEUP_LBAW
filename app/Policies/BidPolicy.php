<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bid;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BidPolicy
{
    use HandlesAuthorization;

}
