<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\File;
use App\Models\Auction;
use App\Models\AuctionNotification;
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
    public function showPreview($id)
    {
      $auction = Auction::find($id);
      $user = User::where('user_id', $auction->seller_id)->first();
      return view('pages.auctionPreview', ['auction' => $auction, 'user' => $user]);
    }

    public function showFull($id)
    {
      $auction = Auction::find($id);
      $bid = DB::table('bid')->where('auction_id', $id)->orderBy('bid_value', 'desc')->get()->first();
      if($bid != null)
        $bidder = DB::table('users')->where('user_id', $bid->bidder_id)->get()->first();
      else
        $bidder = null;
      $user = User::where('user_id', $auction->seller_id)->first();

      $bids = Bid::where('auction_id', $id)->orderBy('bid_value', 'desc')->get();

      $bidsDetails = [];
      foreach($bids as $bid){
        $auction = Auction::all()->where('auction_id', $bid->auction_id)->first();

        $bidder = User::where('user_id', $bid->bidder_id)->first();
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
      

      $notif = null;
      if(Auth::check())
        $notif = AuctionNotification::all()->where('notified_id', Auth::user()->user_id)->count();
      return view('pages.auctionFull', ['auction' => $auction, 'bid' => $bid, 'bidder' => $bidder,'user' => $user, 'bids' => $bidsDetails, 'notif' => $notif, 'winner'=>$winner]);
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
      $notif = null;
      if(Auth::check())
        $notif = AuctionNotification::all()->where('notified_id', Auth::user()->user_id)->count();

      return view('pages.auctions', ['auctions' => $auctions, 'notif' => $notif]);
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
      

      // $request->validate([
      //   'file' => 'required|mimes:jpg,png,csv,txt,xlx,xls,pdf|max:2048'
      //   ]);

        $fileModel = new File;

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
            $auction->auction_image = $fileName;
        }
     
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
