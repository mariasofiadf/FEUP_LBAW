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
            ->orWhere('title','like','%'.$query.'%')
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
        
        

        // if(isset($_POST['submit'])){
        //     if(!empty($_POST['category'])) {
        //         $selected = $_POST['category'];
        //         echo 'You have chosen: ' . $selected;
        //     } else {
        //         echo 'Please select the value.';
        //     }
        // }


        //$auctions = Auction::all()->where('title','like','E%'); 

        // display 15 auctions per page
        //$auctions = $query->paginate(15);

        //$request->flash();

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