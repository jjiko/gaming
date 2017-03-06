<?php
// api
Route::group(['prefix' => '/api/g', 'namespace' => 'Jiko\Gaming\Http\Controllers'], function () {
  Route::group(['prefix' => '/gb'], function() {
    Route::get('/game', function(){
      $url = 'http://www.giantbomb.com/api/search?api_key=' . getenv('GIANT_BOMB_API') . '&resource_type=game&query='.urlencode(Input::get('query')).'&format=json';
      $context = stream_context_create(['http' => ['user_agent' => 'Jiko API UA']]);
      $response = json_decode(file_get_contents($url, false, $context));
      return response()->json($response);
    });
  });
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
    Route::get('/', ['as' => 'steam', 'uses' => 'SteamController@index']);
  });
});

// pages
Route::group(['namespace' => 'Jiko\Gaming\Http\Controllers\Page'], function () {
  Route::get('gaming', ['as' => 'gaming', 'uses' => 'GamingPageController@index']);
  Route::get('monsterhunter', ['as' => 'mh4u', 'uses' => 'GamingPageController@monsterHunter']);
  Route::group(['prefix' => '/stream'], function(){
    Route::get('overlay', 'GamingPageController@streamOverlay');
  });
});
