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

/** サインアップのフロー */
Route::get('/sign_up/auth_info', GuildMemberRegistrationController::class.'@showAuthInfo')->name('show_sign_up_auth_info');
Route::post('/sign_up/auth_info', GuildMemberRegistrationController::class.'@doAuthInfo')->name('do_sign_up_auth_info');
Route::get('/sign_up/profile', GuildMemberRegistrationController::class.'@showProfile')->name('show_sign_up_profile');
Route::post('/sign_up/profile', GuildMemberRegistrationController::class.'@doProfile')->name('do_sign_up_profile');
Route::get('/sign_up/school_info', GuildMemberRegistrationController::class.'@showSchoolInfo')->name('show_sign_up_school_info');
Route::post('/sign_up/school_info', GuildMemberRegistrationController::class.'@doSchoolInfo')->name('do_sign_up_school_info');
Route::post('/sign_up', SignUpController::class.'@store')->name('post_sign_up');
Route::post('/sign_in', SignInController::class.'@store')->name('post_sign_in');

/** パーティー作成のフロー */
Route::get('/party/registration/production_idea', PartyRegistrationController::class.'@showProductionIdea')->name('show_party_registration_production_idea');
Route::get('/party/registration/wanted', PartyRegistrationController::class.'@showWanted')->name('show_party_registration_wanted');
Route::get('/party/registration/confirm', PartyRegistrationController::class.'@showConfirm')->name('show_party_confirm');
Route::post('/party', PartyController::class.'@store')->name('store_party');

Route::post('/guild_member', GuildMemberController::class.'@update')->name('update_guild_member');

Route::delete('/guild_member/delete', GuildMemberController::class.'@destroy')->name('destroy_guild_member');

/** パーティー編集 */
Route::get('/party/edit', function() {
    return view('guild.party.edit');
});

/** パーティー詳細表示 */
Route::get('/party/detail', function() {
    return view('guild.party.detail');
});

/** 検索 */
Route::get('/search', function() {
    return view('guild.search.party');
});

/** パーティー管理 */
Route::get('/party/management/holding', function() {
    return view('guild.party.management.holding');
});
Route::get('/party/management/entry', function() {
    return view('guild.party.management.entry');
});
Route::get('/party/management/applying', function() {
    return view('guild.party.management.applying');
});
