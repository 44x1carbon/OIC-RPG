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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/sign_up', function() {
   return view('signup');
});

Route::post('/sign_up', SignUpController::class.'@store')->name('post_sign_up');

Route::post('/party', PartyController::class.'@store')->name('store_party');
