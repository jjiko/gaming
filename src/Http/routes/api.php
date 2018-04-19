<?php

// api
Route::group(['prefix' => '/api/g', 'namespace' => 'Jiko\Gaming\Http\Controllers'], function () {
  Route::group(['prefix' => '/stream'], function () {
    Route::get('template', 'Api\StreamApiController@getTemplate');
    Route::get('now-playing', 'Api\StreamApiController@getNowPlaying');

    // OBS Studio
    Route::get('obs-info', 'Api\StreamApiController@getObsInfo');
    Route::get('obs-start', 'Api\StreamApiController@obsStart');
    Route::get('obs-stop', 'Api\StreamApiController@obsStop');
  });

  Route::group(['prefix' => '/psn'], function() {
    Route::get('/', 'Api\PlaystationApiController@index');
  });

  // giant bomb
  Route::group(['prefix' => '/gb'], function () {
    Route::get('/platform/{id}', 'Api\GiantBombApiController@platform');
    Route::get('/platforms', 'Api\GiantBombApiController@platforms');
    Route::get('/game/{id}', 'Api\GiantBombApiController@game');
    Route::get('/games', 'Api\GiantBombApiController@games');
  });
  Route::group(['prefix' => '/steam'], function () {
    Route::get('/', ['as' => 'steam', 'uses' => 'SteamController@index']);
    Route::group(['prefix' => 'games'], function () {
      Route::get('/{id}/recent', 'SteamController@gamesRecentlyPlayed');
    });
  });
});