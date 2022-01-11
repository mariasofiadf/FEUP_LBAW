<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;

class BidController extends Controller
{

    /**
     * Shows all of user's bids.
     *
     * @return Response
     */
    public function myBids()
    {
      $bids = Auth::user()->bids()->orderBy('bid_date','desc')->get();

      return view('pages.bids', ['bids' => $bids]);
    }



}
