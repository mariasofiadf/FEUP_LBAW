<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;

class AuctionController extends Controller
{

    //protected $redirectTo = '/auctions';
    /**
     * Shows the auction for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $auction = Auction::find($id);
      
      $user = User::find($auction->seller_id);

      $bids = $auction->bids()->orderBy('bid_value', 'desc')->get();
      $highbid = $bids->first();

      $highbidder = null;
      if($highbid != null)
        $highbidder = $highbid->bidder()->first();

      $bidsDetails = [];
      foreach($bids as $bid){
        $auction = $bid->auction()->first();
        $bidder = $bid->bidder()->first();
        $bidd['auction_id'] = $auction->auction_id;
        $bidd['name'] = $auction->title;
        $bidd['bid_value'] = $bid->bid_value;
        $bidd['bid_date'] = $bid->bid_date;
        $bidd['bidder'] = $bidder->name;
        array_push($bidsDetails, $bidd);
      }
      $winBid = null; $winner = null;
      if($auction->win_bid != null){
        $winBid = Bid::find($auction->win_bid);
        if($winBid != null)
          $winner = User::find($winBid->bidder_id);
      }
      
      return view('pages.auctionFull', ['auction' => $auction, 'bid' => $highbid, 'bidder' => $highbidder,'user' => $user, 'bids' => $bidsDetails, 'winner'=>$winner]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
      //$auctions = Auction::where('status', 'Active')->get();
      $auctions = Auction::all();
      return view('pages.auctions', ['auctions' => $auctions]);
    }

    /**
     * Creates a new auction.
     *
     * @return Auction The auction created.
     */
    public function create(Request $request)
    {
      $auction = new Auction();

      $this->authorize('create', $auction);

      $auction->title = $request->input('title');

      $auction->description = $request->input('description');
      $auction->min_opening_bid = $request->input('min_opening_bid');
      $auction->min_raise = $request->input('min_raise');
      $auction->start_date = date("Y/m/d");
      $auction->predicted_end = date("Y/m/d");
      $auction->close_date = date("Y/m/d");

      $auction->status = $request->input('auction_status');
      $auction->category = $request->input('auction_category');
      $auction->seller_id = Auth::user()->user_id;

      $auction->save();
      return redirect('/auctions');
      //return $auction;
    }

    public function edit($id, Request $request){
      $auction = Auction::find($id);

      $auction->title = $request->input('title');

      $auction->description = $request->input('description');
      $auction->min_opening_bid = $request->input('min_opening_bid');
      $auction->min_raise = $request->input('min_raise');
      $auction->start_date = date("Y/m/d");
      $auction->predicted_end = date("Y/m/d");
      $auction->close_date = date("Y/m/d");

      $auction->status = $request->input('auction_status');
      $auction->category = $request->input('auction_category');

      $auction->save();
      return redirect()->route('auctions/{id}', $id);
    }

    public function delete(Request $request, $id)
    {
      $auction = Auction::find($id);

      $this->authorize('delete', $auction);
      $auction->delete();
      return redirect('/auctions');
      //return $auction;
    }

    public function showAuctionCreationForm(){
      
      if (!Auth::check()) return redirect('/login');
      return view('pages.auctionCreate',['auction' => null]);
    }

    public function showEditForm($id){
      if (!Auth::check()) return redirect('/login');
      $auction = Auction::find($id);
      return view('pages.auctionCreate', ['auction' => $auction]);
    } 


    public function bid(Request $request, $id)
    {
      $bid = new Bid();

      $this->authorize('create', $bid);

      $bid->bid_value = $request->input('bid_value');
      $bid->auction_id = $id;
      $bid->bidder_id = Auth::user()->user_id;
      $bid->bid_date = date("Y-m-d H:i:s"); 

      $bid->save();
      return redirect()->route('auctions/{id}', $id);
      return $bid;
    }

    public static function setWinner($auction_id){

      $winBid = Bid::where('auction_id',$auction_id)->orderBy('bid_value','desc')->get()->first();
      $auction = Auction::find($auction_id);
      if($winBid != null)
        $auction->win_bid = $winBid->bid_id;
      $auction->status = 'Closed';
      $auction->save();
    }

    public static function checkAuctionEnd(){
      $auctions = Auction::where('status', 'Active')->get();
      foreach($auctions as $a){
          if($a->close_date < date("Y-m-d H:i:s"))
            AuctionController::setWinner($a->auction_id);
      }
    }
}
