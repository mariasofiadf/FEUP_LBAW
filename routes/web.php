<?php

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

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

//Auctions
Route::get('auctions', 'AuctionController@list');
Route::get('auctions/{id}', 'AuctionController@showFull')->name('auctions/{id}');
Route::get('auctions/{id}/delete', 'AuctionController@delete');
Route::post('auctions/{id}/bid', 'AuctionController@bid')->name('auctions/{id}/bid');
Route::get('auctions/{id}/edit', 'AuctionController@showEditForm');
Route::put('auctions/{id}/edit', 'AuctionController@edit')->name('auctions/{id}/edit');
Route::get('create', 'AuctionController@showAuctionCreationForm');
Route::put('api/auctions', 'AuctionController@create')->name('api/auctions');
Route::delete('api/auctions/{auction_id}', 'AuctionController@delete');


Route::get('mybids', 'BidController@myBids');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

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
Route::get('users', 'UserController@list');
