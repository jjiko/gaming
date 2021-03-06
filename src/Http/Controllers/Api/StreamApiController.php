<?php namespace Jiko\Gaming\Http\Controllers\Api;

use Jiko\Auth\User;
use Jiko\Http\Controllers\Controller as BaseController;

use Illuminate\Support\Facades\Input;
use WebSocket\Client;

class StreamApiController extends BaseController
{
  function __construct()
  {
    $this->client = new Client("ws://localhost:4444");
    parent::__construct();
  }

  public function getObsInfo()
  {
    $this->client->send(json_encode(['request-type' => 'GetStreamingStatus', 'message-id' => md5(rand())]));
    $status = json_decode($this->client->receive());

    return response()->json($status);
  }

  public function obsStop()
  {
    $info = $this->getObsInfo();
    if ($info->getData()->streaming) {
      // toggle streaming
      $this->client->send(json_encode(['request-type' => 'StartStopStreaming', 'message-id' => md5(rand())]));
      return response()->json(json_decode($this->client->receive()));
    }

    return $info;
  }

  public function obsStart()
  {
    $info = $this->getObsInfo();
    if (!$info->getData()->streaming) {
      $this->client->send(json_encode(['request-type' => 'StartStopStreaming', 'message-id' => md5(rand())]));
      return response()->json(json_decode($this->client->receive()));
    }

    return $info;
  }

  public function getTemplate()
  {
    \Debugbar::disable();
    $name = request()->has('name') ? request()->input('name') : 'cover';
    if(!$user = User::find(request()->input('uid'))) {
      return '400 Invalid request (uid).';
    }

    if(!$game = $user->games()->live()->orderBy('updated_at', 'asc')->with('platforms')->first()) {
      $live = null;
      $platform = null;
    }
    else {
      $platform = $game->platforms->first();
    }

    return view('gaming::stream.' . $name, [
      'game_user' => $user,
      'game' => $game,
      'platform' => $platform,
    ]);
  }

  public function getNowPlaying()
  {
    $current_user_game = request()->user()->games()->orderBy('updated_at', 'asc')->with('platforms')->first();
    $id = request()->has('id') ? request()->input('id') : $current_user_game->gbid;
    $pid = request()->has('platform') ? request()->input('platform') : $current_user_game->pivot->platform_id;
    $game = json_decode(file_get_contents("http://local.joejiko.com/api/g/gb/game/$id?platform=$pid"));
    $platform = json_decode(file_get_contents("http://local.joejiko.com/api/g/gb/platform/$pid"));
    return view('gaming::stream.now-playing', ['game' => $game->results[0], 'platform' => $platform->results[0]]);
  }
}