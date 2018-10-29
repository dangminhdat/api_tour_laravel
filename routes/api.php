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
// route post login
Route::post('/logout', ['as' => 'logout', 'uses' => 'Api\UserController@logout']);

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

// review of tour
Route::GET('review/tour/{id}', 'Api\ReviewController@review_by_tour');
// restful api review
Route::resource('review', 'Api\ReviewController');

// restful api formality
Route::resource('formality', 'Api\FormalityController');

// get data by sales
Route::GET('tour/sales', 'Api\TourController@tour_by_sales');
// get data by type tour
Route::GET('tour/type-tour/{id}', 'Api\TourController@tour_of_type');
// get data by location
Route::GET('tour/location/{id}', 'Api\TourController@tour_by_location');
// restful api tour
Route::resource('tour', 'Api\TourController');

// restful api location
Route::resource('location', 'Api\LocationController');