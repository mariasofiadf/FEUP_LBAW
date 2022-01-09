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
      $bids = Bid::where('bidder_id', Auth::user()->user_id)->get();

      $bidsDetails = [];
      foreach($bids as $bid){
        $auction = Auction::all()->where('auction_id', $bid->auction_id)->first();
        $bidd['auction_id'] = $auction->auction_id;
        $bidd['name'] = $auction->title;
        $bidd['bid_value'] = $bid->bid_value;
        $bidd['bid_date'] = $bid->bid_date;
        array_push($bidsDetails, $bidd);
      }

      return view('pages.bids', ['bids' => $bidsDetails]);
    }



}
