<?php namespace Jiko\Gaming\Http\Controllers;

use Jiko\Http\Controllers\Controller;

use Jiko\Gaming\Steam\Player;
use Jiko\Gaming\Steam\PlayerCollection;

class SteamController extends Controller
{

  public function index()
  {
    $players = (new PlayerCollection(['76561198058839919']));
    return response()->json($players);
  }

  public function gamesRecentlyPlayed($id = '76561198058839919')
  {
    return response()->json((new Player($id))->gamesrecentlyplayed);
  }
}