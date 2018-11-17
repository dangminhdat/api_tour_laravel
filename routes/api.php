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

Route::group([ 'middleware' => ['check_login']], function () {
    // route post login
	Route::post('/logout', 'Api\UserController@logout');
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
	// api update location
	Route::POST('location/{id}', 'Api\LocationController@updateLocation');
	// api get review user
	Route::get('user/review', 'Api\UserController@review_by_user');
	// api get group
	Route::resource('group', 'Api\GroupController');
	// api update tour
	Route::POST('tour/{id}', 'Api\TourController@updateTour');
});

/**
 * No login
 */
// route post login
Route::post('/login', 'Api\UserController@login');
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
// get 5 tour lastest
Route::get('tour/latest', 'Api\TourController@five_tour_latest');
// restful api tour
Route::resource('tour', 'Api\TourController');
// get 5 location favorite
Route::get('location/favorite', 'Api\LocationController@favorite_four_location');
// restful api location
Route::resource('location', 'Api\LocationController');
// restful api detail
Route::resource('detail', 'Api\DetailTourController');
// restful api detail
Route::get('detail/other/{id}', 'Api\DetailTourController@detail_day_other');
// upload image
Route::POST('upload', 'Api\TourController@upload_image');
