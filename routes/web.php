<?php

use App\Http\Resources\RestaurantResource;
use App\Restaurant;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/restaurant/{any}', function() {
    return view('welcome');
})->where('any', '.*');

Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::post('/', 'HomeController@setImage')->name('setImage');
    Route::put('/{admin}', 'HomeController@changeImage')->name('changeImage');
    Route::resource('/dishes', DishController::class);
    Route::resource('/orders', OrderController::class);
});
