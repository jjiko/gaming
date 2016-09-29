<?php namespace Jiko\Gaming\Http\Controllers;

use Jiko\Http\Controllers\Controller;

class SteamController extends Controller {

  public function index()
  {
    $players = (new PlayerCollection(['76561198058839919']));
    dd($players);
  }
}