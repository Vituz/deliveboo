<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\RestaurantResource;
use App\Restaurant;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', 'API\CategoryController@index');
Route::get('restaurants', 'API\RestaurantController@index');

Route::get('restaurants/{restaurant}','API\RestaurantController@show');

// Route::get('restaurants/{restaurant}', 'API\RestaurantController@show');
