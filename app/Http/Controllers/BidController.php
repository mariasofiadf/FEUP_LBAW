<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;

class BidController extends Controller
{

    //protected $redirectTo = '/auctions';


    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function myBids()
    {
      $bids = Bid::where('bidder_id', Auth::user()->$user_id)->get();
      return view('pages.bids', ['bids' => $bids]);
    }

}
