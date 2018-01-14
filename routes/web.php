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
Route::get('/sign_in', function() {
    return view('SignIn');
})->name('show_sign_in');
Route::post('/sign_in', SignInController::class.'@store')->name('post_sign_in');

/** パーティー作成のフロー */
Route::get('/party/registration/production_idea', PartyRegistrationController::class.'@showProductionIdea')->name('show_party_registration_production_idea');
Route::post('/party/registration/production_idea', PartyRegistrationController::class.'@doProductionIdea')->name('do_party_registration_production_idea');
Route::get('/party/registration/wanted', PartyRegistrationController::class.'@showWanted')->name('show_party_registration_wanted');
Route::post('/party/registration/wanted', PartyRegistrationController::class.'@handleWanted')->name('do_party_registration_wanted');
Route::get('/party/registration/confirm', PartyRegistrationController::class.'@showConfirm')->name('show_party_confirm');
Route::post('/party', PartyController::class.'@store')->name('store_party');

Route::post('/guild_member', GuildMemberController::class.'@update')->name('update_guild_member');

Route::delete('/guild_member/delete', GuildMemberController::class.'@destroy')->name('destroy_guild_member');

/** マイページ */
Route::get('/me/my_page', GuildMemberController::class.'@myPage')->name('show_my_page');
/** マイページ */
Route::get('/guild_members/{studentNumber}', GuildMemberController::class.'@userPage')->name('show_user_page');

/** パーティー編集 */
Route::get('/party/edit', function() {
    return view('guild.party.edit');
});

/** パーティー詳細表示 */
Route::get('/party/{partyId}/detail', PartyController::class.'@detail')->name('show_party_detail');

/** パーティ参加申請 */
Route::post('/party/{partyId}/send/{wantedRoleId}', PartyParticipationRequestController::class.'@store')->name('store_party_participation_request');
Route::delete('/party_participation_request/{partyParticipationRequestId}/delete', PartyParticipationRequestController::class.'@destroy')->name('destroy_party_participation_request');

/** 検索 */
Route::get('/party/search', PartyController::class.'@search' )->name('search_party');

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

Route::get('/party/management/participation_request_list', GuildMemberController::class.'@managedParticipationRequestList')
    ->name('shoe_participation_request_list');


/** ジョブ習得 */
Route::post('/me/get_job', GuildMemberController::class.'@getJob')->name('do_get_job');

/** お気に入りのジョブの設定 */
Route::post('/me/favorite_job', GuildMemberController::class.'@setupFavoriteJob')->name('do_favorite_job');

/** デバッグ用 */
if(env('APP_ENV', 'local') == 'local') {
    Route::get('/debug/learn_skill', DebugController::class.'@showLearnSkill')->name('show_learn_skill');
    Route::post('/debug/learn_skill', DebugController::class.'@doLearnSkill');
    Route::get('/debug/sign_in', DebugController::class.'@showSignIn')->name('show_sign_in');
    Route::post('/debug/sign_in', DebugController::class.'@doSignIn');
}

Route::get('/top', function(\App\Domain\GuildMember\GuildMember $loginMember) {
   return view('Top')
       ->with('guildMember', new \App\Infrastracture\GuildMember\GuildMemberViewModel($loginMember));
})->name('top');

Route::get('/guild', function() {
    return view('Guild.Top');
})->name('show_guild');

Route::get('/', function(){
    return view('landing');
});
