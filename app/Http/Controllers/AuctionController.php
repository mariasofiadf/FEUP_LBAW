<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;

use Carbon\Carbon;

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

      $bids = $auction->bids()->orderBy('bid_value', 'desc')->get();
      
      return view('pages.auctionFull', ['auction' => $auction, 'bids' => $bids]);
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

    public function validated(Request $request){
      $validator = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'min_opening_bid' => 'required|integer',
        'min_raise' => 'required|integer',
        // 'start' => 'date_format:YYYY-MM-DDThh:mm',
        // 'close' => 'date_format:YYYY-MM-DDThh:mm|after:start',
        'predicted_end' => 'date_format:Y/m/d|after:now',
        'auction_status' => 'required',
        'auction_category' => 'required'
      ]);
      return $validator;
    }
    /**
     * Creates a new auction.
     *
     * @return Auction The auction created.
     */
    public function create(Request $request)
    {
      $this->authorize('create', Auction::class);
      
      $validator = $this->validated($request);

      $auction = Auction::create([
        'title' => $validator['title'],
        'description' => $request->input('description'),
        'min_opening_bid' => $request->input('min_opening_bid'),
        'min_raise' => $request->input('min_raise'),
        'start_date' => Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start'))->format('Y-m-d H:i:00'),
        'close_date' => Carbon::createFromFormat('Y-m-d\TH:i', $request->input('close'))->format('Y-m-d H:i:00'),
        'predicted_end' => Carbon::createFromFormat('Y-m-d\TH:i', $request->input('close'))->format('Y-m-d H:i:00'),
        'status' => $validator['auction_status'],
        'category' => $validator['auction_category'],
        'seller_id' => Auth::user()->user_id
      ]);
      $auction->save();

      return redirect('/auctions');
    }

    public function edit($id, Request $request){
      $auction = Auction::find($id);

      $this->authorize('edit', $auction);

      $validator = $this->validated($request);

      $auction->title = $request->input('title');
      $auction->description = $request->input('description');
      $auction->min_opening_bid = $request->input('min_opening_bid');
      $auction->min_raise = $request->input('min_raise');
      $auction->start_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start'))->format('Y-m-d H:i:00');
      $auction->predicted_end = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('close'))->format('Y-m-d H:i:00');
      $auction->close_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('close'))->format('Y-m-d H:i:00');

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
    }

    public static function setWinner($auction_id){

      $auction = Auction::find($auction_id);
      $winBid = $auction->bids()->orderBy('bid_value','desc')->get()->first();
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
