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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/slack',          'Auth\SlackAuthController@redirectToProvider');
Route::get('auth/slack/callback', 'Auth\SlackAuthController@handleProviderCallback');
Route::get('auth/slack/logout',   'Auth\SlackAuthController@logout');

Auth::routes();

Route::resource('teams', 'TeamController', ['only' => ['index', 'show', 'store', 'update']]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sl', function () {
//    $m = new \App\Slack;
//    dd($m->usersInfo());
    dd(\App\Slack::usersInfo());
    $r = $m->usersProfileSet('APIでステータスセットしました', ':100:');
});