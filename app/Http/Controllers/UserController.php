<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Auction;
use App\Models\Rating;
use App\Models\AuctionNotification;
use App\Models\File;

class UserController extends Controller
{

    protected $redirectTo = '/users';
    
    public function validated(Request $request){
      $validator = $request->validate([

        'rate_value' => 'required|integer',
        'min_raise' => 'required|integer',
        'start' => 'date_format:Y-m-d\TH:i',
        'close' => 'date_format:Y-m-d\TH:i|after:start',
        'predicted_end' => 'date_format:Y/m/d|after:now',
        'auction_status' => 'required',
        'auction_category' => 'required',
        'file' => 'required|mimes:jpg,png,csv,txt,xlx,xls,pdf|max:2048'
      ]);
      return $validator;
    }

    /**
     * Shows all Users.
     *
     * @return Response
     */
    public function list()
    {
      $users = User::all();
      return view('pages.users', ['users' => $users]);
    }

    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id) {
        $user = User::find($id);
        if ($user == null || $user->deleted)
            return abort(404);

        return view('pages.userProfile', ["user" => $user]);
    }

    /**
     * Rating a user.
     *
     * @param  int  $id of the user being rated
     * @return Response
     */
    public function rate(Request $request, $id) {

      $rating = Rating::where('id_rates', Auth::id())->where('id_rated', $id)->first();

      if(is_null($rating)){
        $rating = new Rating();
        $rating->id_rates = Auth::id();
        $rating->id_rated = $id;
      }
      
      $rate = $request->input('rating');
      $rating->rate_value = $rate;

      $rating->save();

      return User::find($id);
  }


    public function showNotifications(){
      $notifs = Auth::user()->userNotifs()->get();
      
      return view('pages.notifications', ["notifs"=>$notifs]);
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

      $fileModel = new File;

      $request->validate([
        'file' => 'mimes:jpg,png|max:2048'
        ]);

      
      //echo $request->file();

      if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            
            $user->profile_image = $fileName;
      }

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
