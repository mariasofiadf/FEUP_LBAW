<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\AuctionReport;
use App\Models\User;

class StaticController extends Controller
{

    //protected $redirectTo = '/auctions';


    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function showAbout()
    {
        return view('pages.about');
    }

    public function showContacts()
    {
        return view('pages.contacts');
    }

    public function showFaq()
    {
        return view('pages.faq');
    }

    public function showComplaints()
    {   
        if(!Auth::check()) return redirect('/login');
        //$auction = Auction::find($id);
        $auctionReports = AuctionReport::all();//where('auction_id', $id);
        return view('pages.auctionComplaints', ['auctionReports' => $auctionReports]);
    }

}
