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
        
        $query = $request->input('query');
        $category = $request->input('category');
        if($category && $query != ''){
            $auctions = DB::table('auction')
            ->where('category','like','%'.$category.'%')
            ->where('title','like','%'.$query.'%')
            ->get();
        }else if($category){
            $auctions = DB::table('auction')
            ->where('category','like','%'.$category.'%')
            ->get();
        }
        else{
            $auctions = DB::table('auction')->where('title','like','%'.$query.'%')
            ->orWhere('category','like','%'.$query.'%')->orWhere('description','like','%'.$query.'%')
            ->get();
        }

        return view('pages.auctions')->with('auctions', $auctions);
    }

    public function search_user(Request $request) {
        $query = $request->input('query');
        $users = DB::table('users')->where('username','like','%'.$query.'%')
        ->orWhere('name','like','%'.$query.'%')
        ->get();

        return view('pages.users')->with('users', $users);
    }


}