<?php

// admin
Route::group(['prefix' => '/admin', 'namespace' => 'Jiko\Gaming\Http\Controllers\Admin'], function () {
  Route::name('admin.gaming')->get('gaming', 'AdminPageController@index');
  Route::group(['prefix' => '/gaming'], function () {
    Route::name('admin:gaming_event_test')->get('event-test', 'AdminPageController@eventTest');
    Route::post('event-test', 'AdminPageController@eventTest');
    Route::post('game/live', 'AdminPageController@setGameLive');
    // user game
    Route::post('game', 'AdminPageController@create');
    Route::put('game', 'AdminPageController@update');
    Route::delete('game', 'AdminPageController@delete');
    // games data
    Route::name('admin_game_list')->get('game/list', 'AdminPageController@gameList');
    Route::get('game/{id}', 'GamePageController@show');
    Route::put('game/{id}', 'GamePageController@update');
    // platforms data
    Route::name('admin_platform_list')->get('platform/list', 'AdminPageController@platformList');
    Route::put('platform/{id}', 'PlatformPageController@update');
    // etc
    Route::get('go-live', 'AdminPageController@streamLive');
    Route::get('stream-preview', 'AdminPageController@streamPreview');
    Route::get('stream-status', 'AdminPageController@streamStatus');
    Route::get('stream-publish', function () {
      dd(shell_exec('"C:\Program Files\Git\mingw64\bin\curl.exe" "rtmp://localhost/publish/test" -m 1 -o /dev/null 2>&1'));
    });
    Route::group(['prefix' => 'twitch'], function () {
      Route::name('admin_twitch')->get('/', 'TwitchPageController@index');
    });
  });
});