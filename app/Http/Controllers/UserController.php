<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Auction;

class UserController extends Controller
{

    protected $redirectTo = '/users';
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }

    /**
     * Shows all Users.
     *
     * @return Response
     */
   /**public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Auction::class);
      $auctions = Auth::user()->ownedAuctions()->get();
      return view('pages.auctions', ['auctions' => $auctions]);
    }*/

    /**
     * Shows user Profile.
     *
     * @param username 
     * @return Response
     */
    public function showProfile($username ) {
        $user = User::all()->where('username', '=', $username)->first();
        if ($user == null || $user->deleted)
            return abort(404);

        return view('pages.user_profile', ["user" => $user]);
    }

     /**
     * Shows own Profile.
     * 
     * @return Response
     */
    public function showMyProfile() {
        $auctions = Auction::all()->where('seller_id', Auth::user()->user_id);
        return view('pages.user_profile', ["user" => Auth::user(), "auctions" => $auctions]);
    }

      

    public function delete(Request $request, $id)
    {
      $user = User::User($id);

      $this->authorize('delete', $user);
      $user->delete();

      return $user;
    }
}
