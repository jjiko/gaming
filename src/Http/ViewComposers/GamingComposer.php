<?php

namespace Jiko\Gaming\Http\ViewComposers;

use Illuminate\View\View;
use Jiko\Auth\User;
use Jiko\Gaming\Twitch\Twitch;

class GamingComposer
{
  protected $twitch;
  protected $games;
  protected $games_grouped;
  protected $networks;

  public function __construct(Twitch $twitch, User $user)
  {
    $this->twitch = $twitch->stream();
    $this->games = $user::find(2)->games()->wherePivot('status', 'Playing')->with('platforms')->get();
    $games_sorted = $this->games->random(min(count($this->games), 8))->sort(function ($a, $b) {
      return strcmp($a->platforms->first()->name, $b->platforms->first()->name);
    });
    $this->networks = json_decode(file_get_contents(__DIR__ . '/../../storage/networks.json'));
    $this->games_grouped = $games_sorted->split(ceil(count($games_sorted) / 4));
    view()->share([
        'layout' => (object)[
          'config' => ['main.class' => 'no-sidebar'],
        ]
      ]
    );
  }

  public function compose(View $view)
  {
    $view->with([
      'twitch' => $this->twitch,
      'games_count' => $this->games->count(),
      'games_grouped' => $this->games_grouped,
      'networks' => $this->networks,
      'TwitchStatus' => $this->twitch->stream ? "online" : "offline"
    ]);
  }
}