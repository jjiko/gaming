<?php
// api
Route::group(['prefix' => '/api/g', 'namespace' => 'Jiko\Gaming\Http\Controllers'], function () {
  Route::group(['prefix' => '/psn'], function () {
    Route::get('/', function () {
      return view('api.g.psn');
    });
    Route::get('register', function () {
      return "@todo";
    });
    Route::get('{id}', ['uses' => 'PSNController@profile']);
    Route::get('{id}/trophies', ['uses' => 'PSNController@trophies']);
    Route::get('{id}/trophies/{npCommID}', ['uses' => 'PSNController@trophiesByGame']);
  });
  Route::group(['prefix' => '/steam'], function () {
    Route::get('/', ['as' => 'steam', 'uses' => 'Jiko\Vendor\Steam\SteamController@index']);
  });
});

// pages
Route::group(['namespace' => 'Jiko\Http\Controllers\Page'], function () {
  Route::get('gaming', ['as' => 'gaming', 'uses' => 'PageController@gaming']);
  Route::get('monsterhunter', ['as' => 'mh4u', 'uses' => 'PageController@monsterHunter']);
});
