<?php
// pages
Route::group(['namespace' => 'Jiko\Gaming\Http\Controllers\Page'], function () {
  Route::group(['prefix' => '/gaming'], function () {
    Route::name('gaming')->get('/', 'GamingPageController@index');
    Route::name('gaming_chat')->get('/chat', 'GamingPageController@chat');
    Route::name('gaming_widget')->any('/embed/widget', 'GamingPageController@widget');
    Route::name('gaming_networks')->get('/networks', 'GamingPageController@networks');
    Route::name('gaming_platforms')->get('/platforms', 'GamingPageController@platforms');
    Route::name('gaming_platform')->get('/platform/{abbriviation}', 'GamingPageController@platform');
    Route::name('gaming_all_games')->get('/all-games', 'GamingPageController@allGames');
    Route::name('game_user_profile')->get('/user/{id}', 'GamingPageController@user');
  });
  Route::get('monsterhunter', ['as' => 'mh4u', 'uses' => 'GamingPageController@monsterHunter']);
  Route::group(['prefix' => '/stream'], function () {
    Route::get('overlay', 'GamingPageController@streamOverlay');
  });
});
