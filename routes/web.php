<?php

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
    /* $links = config('dtype.links');
    ddd($links[0]['text']);
    $categories = config('dtype.categories');
    $contacts = config('dtype.contacts');
    $pay_methods = config('dtype.pay_methods');
    $socials = config('dtype.socials');
 */
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::post('/', 'HomeController@setImage')->name('setImage');
    Route::put('/{admin}', 'HomeController@changeImage')->name('changeImage');
    Route::resource('/dishes', DishController::class);
    Route::resource('/orders', OrderController::class);
});


