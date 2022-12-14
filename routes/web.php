<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home
Route::get('/', 'Auth\LoginController@home');
Route::redirect('cards', 'auctions');

//Auctions
Route::get('auctions', 'AuctionController@list');
Route::get('auctions/{id}', 'AuctionController@show')->name('auctions/{id}');
Route::get('auctions/{id}/delete', 'AuctionController@delete');
Route::post('auctions/{id}/bid', 'AuctionController@bid')->name('auctions/{id}/bid');
Route::get('auctions/{id}/edit', 'AuctionController@showEditForm');
Route::put('auctions/{id}/edit', 'AuctionController@edit')->name('auctions/{id}/edit');

Route::get('create', 'AuctionController@showAuctionCreationForm');
Route::put('api/auctions', 'AuctionController@create')->name('api/auctions');
Route::get('reportAuction/{id}', 'AuctionController@showReportForm');
Route::post('auctions/{id}/report', 'AuctionController@report')->name('auctions/{id}/report');

Route::put('api/auctions/{id}/bid', 'AuctionController@bid');
Route::put('api/auctions/{id}/follow', 'AuctionController@follow');
Route::delete('api/auctions/{id}/unfollow', 'AuctionController@unfollow');
Route::put('api/users/{id}/rate', 'UserController@rate');



// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Search
Route::get('search', 'SearchController@search_auctions')->name('search');
Route::get('search_users', 'SearchController@search_user')->name('search_users');

//Users
Route::get('profile/edit', 'UserController@showEditForm');
Route::post('profile/edit', 'UserController@edit')->name('profile/edit');
Route::get('users/{id}', 'UserController@showProfile')->name('users/{id}');
Route::get('users/{id}/del', 'UserController@delete')->name('del');

Route::post('users/{id}/rate', 'UserController@rate')->name('users/{id}/rate');
Route::get('users', 'UserController@list');
Route::get('mybids', 'BidController@myBids');
Route::get('notifications', 'UserController@showNotifications')->name('notifications');

//Static pages
Route::get('about', 'StaticController@showAbout');
Route::get('contacts', 'StaticController@showContacts');
Route::get('faq', 'StaticController@showFaq');
//Route::get('auctionComplaints/{id}', 'AuctionReportController@showComplaints');
Route::get('auctionComplaints', 'StaticController@showComplaints');

//FileUpload
Route::get('/upload-file', [FileUpload::class, 'createForm']);
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');
