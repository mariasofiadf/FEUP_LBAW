<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Auction;
use App\Models\Bid;

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

}
