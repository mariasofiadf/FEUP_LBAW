<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;

class AuctionController extends Controller
{

    protected $redirectTo = '/auctions';
    /**
     * Shows the auction for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $auction = Auction::find($id);
      $this->authorize('show', $auction);
      return view('pages.auction', ['auction' => $auction]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Auction::class);
      $auctions = Auth::user()->ownedAuctions()->get();
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

      $auction->min_opening_bid = $request->input('min_opening_bid');
      $auction->min_raise = $request->input('min_raise');
      $auction->start_date = date("Y/m/d");
      $auction->predicted_end = date("Y/m/d");
      $auction->close_date = date("Y/m/d");
      $auction->status = 'Active';
      $auction->category = 'Book';
      $auction->seller_id = Auth::user()->user_id;

      $auction->save();

      return $auction;
    }

    public function delete(Request $request, $id)
    {
      $auction = Card::Auction($id);

      $this->authorize('delete', $auction);
      $auction->delete();

      return $auction;
    }
}
