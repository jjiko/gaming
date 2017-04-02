<?php

namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;

use Jiko\Gaming\Models\Game;
use Jiko\Gaming\Models\Platform;
use OAuth\OAuth2\Service\Google;

class AdminPageController extends AdminController
{
  protected $layout = 'admin::layouts.default';

  public function index()
  {
    return $this->content('admin::gaming', ['game_collection' => request()->user()->games]);
  }

  protected function streamStatus()
  {
    $guser = request()->user()->OAuthUser()->provider('google')->first();
    $status = [
      'youtube' => json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/liveStreams?part=id,status&mine=true&access_token=" . $guser->token)),
      'twitch' => json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/jjiko?client_id=" . env('TWITCH_CLIENT_ID')))
    ];

    return view('admin::gaming.stream-status', ['status' => (object)[
      'twitch' => !is_null($status['twitch']->stream) ? "online" : "offline",
      'youtube' => (bool)count($status['youtube']->items) ? "online" : "offline"
    ]]);
  }

  public function streamLive()
  {
    $this->setContent('admin::gaming.stream-live');
  }

  public function streamPreview()
  {
    return view('admin::gaming.stream-preview');
  }

  public function show($id)
  {

  }

  public function create()
  {
    $user = request()->user();
    $game_data = Input::get('game');
    $platform_data = $game_data['platform'];

    // check if the game exists already
    if (!$game = Game::where('gbid', Input::get('game_id'))->first()) {
      $game = Game::create([
        'gbid' => Input::get('game_id'),
        'name' => $game_data['name'],
        'image' => json_encode($game_data['img'])
      ]);
    }

    // check if platform exists
    if (!$platform = Platform::where('gbid', $platform_data['id'])->first()) {
      $platform = Platform::create([
        'gbid' => $platform_data['id'],
        'name' => $platform_data['name'],
        'abbreviation' => $platform_data['abbreviation']
      ]);
    }

    // verify game is assigned to platform
    if (!$platformAttached = $game->platforms()->where('gbid', $platform_data['id'])->first()) {
      $game->platforms()->attach($platform->id);
    }

    if ($hasGame = $user->games()->where('gbid', $game_data['id'])->first()) {
      return response()->json($user->games);
    }

    // attach game to user
    $user->games()->attach($game->id, ['platform_id' => $platform->id, 'status' => Input::get('status')]);

    return response()->json($user->games);
  }
}
