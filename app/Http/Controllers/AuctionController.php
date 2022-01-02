<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;

class AuctionController extends Controller
{

    //protected $redirectTo = '/auctions';
    /**
     * Shows the auction for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showPreview($id)
    {
      $auction = Auction::find($id);
      $this->authorize('show', $auction);
      return view('pages.auctionPreview', ['auction' => $auction]);
    }

    public function showFull($id)
    {
      $auction = Auction::find($id);
      $this->authorize('show', $auction);
      $bid = DB::table('bid')->where('auction_id', $id)->orderBy('bid_value', 'desc')->get()->first();
      if($bid != null)
        $bidder = DB::table('users')->where('user_id', $bid->bidder_id)->get()->first();
      else
        $bidder = null;
      return view('pages.auctionFull', ['auction' => $auction, 'bid' => $bid, 'bidder' => $bidder]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
      $auctions = Auction::where('status', 'Active')->get();
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
      $auction->seller_id = Auth::user()->user_id;

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
}
