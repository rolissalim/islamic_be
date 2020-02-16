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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('profile', 'Api\AuthController@getAuthenticatedUser');
Route::get('post', 'Api\PostController@data');
Route::get('city', 'Api\CityController@data');
Route::get('country', 'Api\CountryController@data');
Route::get('category', 'Api\CategoryController@data');
Route::get('mosque/{id}', 'Api\MosqueController@detail');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('user/{id}', 'Api\UserController@detail');   

    Route::get('city_user', 'Api\City_userController@data');    
    Route::get('city_user/{id}', 'Api\CitiesofuserController@detail');

    Route::get('mosque', 'Api\MosqueController@data');
});
