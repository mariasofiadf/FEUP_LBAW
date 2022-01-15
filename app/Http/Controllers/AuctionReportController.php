<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\AuctionReport;

class AuctionReportController extends Controller
{

    public function showComplaints($id)
    {   
        if(!Auth::check()) return redirect('/login');
        $auction = Auction::find($id);
        $auctionReports = AuctionReport::where('auction_id', 'auction_id')->get();
        return view('pages.auctionComplaints', ['auction' => $auction, 'auctionReports' => $auctionReports]);
    }

}