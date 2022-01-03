<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\User;

class SearchController extends Controller {
    public function search_auctions(Request $request) {
        /*$request->validate([
            'query' => 'exists:orders,id',
        ]);*/
        
        $query = $request->input('id');

        $auctions = Auction::where('auction_id',$query)->get();;


        // display 15 auctions per page
        //$auctions = $query->paginate(15);

        //$request->flash();

        return view('pages.searchAuctions')->with('auctions', $auctions)->with('request', $request);
    }


}