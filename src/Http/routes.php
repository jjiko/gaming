<?php
// admin
Route::group(['prefix' => '/admin', 'namespace' => 'Jiko\Gaming\Http\Controllers\Admin'], function () {
  Route::name('admin.gaming')->get('gaming', 'AdminPageController@index');
  Route::group(['prefix'=>'/gaming'], function(){
    Route::post('game', 'AdminPageController@create');
    Route::get('go-live', 'AdminPageCOntroller@streamLive');
    Route::get('stream-preview', 'AdminPageController@streamPreview');
    Route::get('stream-status', 'AdminPageController@streamStatus');
    Route::get('stream-publish', function(){
      dd(shell_exec('"C:\Program Files\Git\mingw64\bin\curl.exe" "rtmp://localhost/publish/test" -m 1 -o /dev/null 2>&1'));
    });
  });
});

// api
Route::group(['prefix' => '/api/g', 'namespace' => 'Jiko\Gaming\Http\Controllers'], function () {
  Route::group(['prefix' => '/stream'], function () {
    Route::get('template', 'Api\StreamApiController@getTemplate');
    Route::get('now-playing', 'Api\StreamApiController@getNowPlaying');
    Route::get('obs-info', 'Api\StreamApiController@getObsInfo');
    Route::get('obs-start', 'Api\StreamApiController@obsStart');
    Route::get('obs-stop', 'Api\StreamApiController@obsStop');
  });
  Route::group(['prefix' => '/gb'], function () {
    Route::get('/platform/{id}', 'Api\GiantBombApiController@platform');
    Route::get('/platforms', 'Api\GiantBombApiController@platforms');
    Route::get('/game/{id}', 'Api\GiantBombApiController@game');
    Route::get('/games', 'Api\GiantBombApiController@games');
  });
  Route::group(['prefix' => '/psn'], function () {
    Route::get('/', function () {
      return view('gaming::api.g.psn');
    });
    Route::get('register', function () {
      return "@todo";
    });
    Route::get('{id}', ['uses' => 'PSNController@profile']);
    Route::get('{id}/trophies', ['uses' => 'PSNController@trophies']);
    Route::get('{id}/trophies/{npCommID}', ['uses' => 'PSNController@trophiesByGame']);
  });
  Route::group(['prefix' => '/steam'], function () {
    Route::get('/', ['as' => 'steam', 'uses' => 'SteamController@index']);
    Route::group(['prefix' => 'games'], function() {
      Route::get('/{id}/recent', 'SteamController@gamesRecentlyPlayed');
    });
  });
});

// pages
Route::group(['namespace' => 'Jiko\Gaming\Http\Controllers\Page'], function () {
  Route::get('gaming', ['as' => 'gaming', 'uses' => 'GamingPageController@index']);
  Route::get('gaming/all-games', 'GamingPageController@allGames');
  Route::name('game_user_profile')->get('gaming/user/{id}', 'GamingPageController@user');
  Route::get('monsterhunter', ['as' => 'mh4u', 'uses' => 'GamingPageController@monsterHunter']);
  Route::group(['prefix' => '/stream'], function () {
    Route::get('overlay', 'GamingPageController@streamOverlay');
  });
});
