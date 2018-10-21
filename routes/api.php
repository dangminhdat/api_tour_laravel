<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// route post login
Route::post('/login', ['as' => 'login', 'uses' => 'UserController@login']);

// restful api user
Route::resource('users', 'UserController');

// api get profile
Route::get('/profile', 'UserController@profile');
// api change pass
Route::POST('/change-pass/{id}', 'UserController@change_pass');
// api lock user
Route::POST('/lock/{id}', 'UserController@lock_user');
// api unlock user
Route::POST('/unlock/{id}', 'UserController@unlock_user');

// restful api guide
Route::resource('guides', 'GuideController');

// restful api hotel
Route::resource('hotels', 'HotelController');

// restful api type tour
Route::resource('type-tour', 'TypeTourController');

// restful api review
Route::resource('review', 'ReviewController');