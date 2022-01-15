<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\AuctionReport;

class AuctionReportController extends Controller
{

    public function showComplaints()
    {
        return view('pages.auctionComplaints');
    }

}