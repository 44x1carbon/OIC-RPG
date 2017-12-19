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


Route::get('/sign_up/auth_info', GuildMemberRegistrationController::class.'@showAuthInfo')->name('show_sign_up_auth_info');
Route::get('/sign_up/profile', GuildMemberRegistrationController::class.'@showProfile')->name('show_sign_up_profile');
Route::get('/sign_up/school_info', GuildMemberRegistrationController::class.'@showSchoolInfo')->name('show_sign_up_school_info');

Route::post('/sign_up', SignUpController::class.'@store')->name('post_sign_up');

Route::post('/guild_member', GuildMemberController::class.'@update')->name('update_guild_member');

Route::delete('/guild_member/delete', GuildMemberController::class.'@destroy')->name('destroy_guild_member');

Route::post('/party', PartyController::class.'@store')->name('store_party');
