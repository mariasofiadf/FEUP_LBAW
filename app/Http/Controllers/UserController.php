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
    public function list()
    {
      //$this->authorize('list', Auction::class);
      $users = User::all()->where('deleted', false);
      return view('pages.users', ['users' => $users]);
    }

    /**
     * Shows user Profile.
     *
     * @param username 
     * @return Response
     */
    public function showProfile($id) {
        $user = User::all()->where('user_id', $id)->first();
        if ($user == null || $user->deleted)
            return abort(404);

        $auctions = Auction::all()->where('seller_id', $id);
        return view('pages.user_profile', ["user" => $user, "auctions" => $auctions]);
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

    public function showEditForm(){
      if (!Auth::check()) return redirect('/login');
      $user = User::find(Auth::id());
      return view('pages.userEdit', ['user' => $user]);
    } 

    public function edit(Request $request,){
      if (!Auth::check()) return redirect('/login');
      $id = Auth::id();
      $user = User::find($id);

      $user->name = $request->input('name');
      $user->username = $request->input('username');
      $user->email = $request->input('email');

      $user->save();
      return redirect()->route('users/{id}', $id);
    } 
      

    public function delete(Request $request, $id)
    {

      //$this->authorize('delete', $user);
      $user = User::find($id);
      $user->delete();


      return redirect('/logout');
    }
}
