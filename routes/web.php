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


//ToDo nameをつける
Route::get('/sign_up/auth_info', GuildMemberRegistrationController::class.'@showAuthInfo');
Route::get('/sign_up/profile', GuildMemberRegistrationController::class.'@showProfile');
Route::get('/sign_up/school_info', GuildMemberRegistrationController::class.'@showSchoolInfo');

Route::post('/sign_up', SignUpController::class.'@store')->name('post_sign_up');

Route::post('/guild_member', GuildMemberController::class.'@update')->name('update_guild_member');

Route::post('/party', PartyController::class.'@store')->name('store_party');
