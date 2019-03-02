<?php

// use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
Route::post('register', 'AuthController@register');

// home
Route::resource('home', 'HomeController', ['only' => ['index']]);
// profile
Route::resource('profile', 'ProfileController');
// photo
Route::resource('photo', 'PhotoController', ['except' => ['update', 'edit']]);
// stage
Route::resource('stage', 'StageController');
// ranking
Route::resource('ranking', 'RankingController', ['only' => ['index']]);
// vote
Route::resource('vote', 'VoteController', ['except' => ['edit']]);
// お気に入り登録
Route::resource('favorite', 'FavoriteController');
// ファン登録
Route::resource('fan', 'FanController');
// Appendix
Route::resource('appendix', 'AppendixController', ['only' => ['show']]);
// Tag Search
Route::get('tag', 'SearchController@getAllTags');
Route::get('tag/{input?}', 'SearchController@getTagsAsSuggest');
Route::get('tag/appropriate/{input?}', 'SearchController@getAppropriateTagAsSuggestByInput');
Route::get('tag/search/{title_id?}/{tag_id?}', 'SearchController@getDataByInputedTags');

// add in future (decouple battleController)
Route::get('user/{resources}/battles', 'UserBattleController@index');
Route::get('user/{resources}/battles/{user_id}', 'UserBattleController@show');
Route::resource('user/battles', 'UserBattleController', ['only' => ['store']]);
Route::get('photo/{resources}/battles/{photo_id}', 'PhotoBattleController@show', ['only' => ['show']]);

// for test
Route::get('test/{title_id}/{tag_id}', 'TestController@test');
