<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;

class AuctionController extends Controller
{
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
      $Auction = new Auction();

      $this->authorize('create', $auction);

      $auction->title = $request->input('title');
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
