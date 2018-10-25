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
Route::post('/login', ['as' => 'login', 'uses' => 'Api\UserController@login']);

// restful api user
Route::resource('users', 'Api\UserController');

// api get profile
Route::get('/profile', 'Api\UserController@profile');
// api change pass
Route::POST('/change-pass/{id}', 'Api\UserController@change_pass');
// api lock user
Route::POST('/lock/{id}', 'Api\UserController@lock_user');
// api unlock user
Route::POST('/unlock/{id}', 'Api\UserController@unlock_user');

// restful api guide
Route::resource('guides', 'Api\GuideController');

// restful api hotel
Route::resource('hotels', 'Api\HotelController');

// restful api type tour
Route::resource('type-tour', 'Api\TypeTourController');

// restful api review
Route::resource('review', 'Api\ReviewController');
// review of tour
Route::POST('review/tour', 'Api\ReviewController@review_by_tour');

// restful api formality
Route::resource('formality', 'Api\FormalityController');

// restful api tour
Route::resource('tour', 'Api\TourController');
// get data by location
Route::POST('tour/location', 'Api\TourController@tour_by_location');

// restful api location
Route::resource('location', 'Api\LocationController');