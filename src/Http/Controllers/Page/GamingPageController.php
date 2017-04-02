<?php namespace Jiko\Gaming\Http\Controllers\Page;

use Jiko\Auth\User;
use Jiko\Http\Controllers\Controller;
use Jiko\Gaming\Twitch\Twitch;

class GamingPageController extends Controller
{
  /**
   * @todo bind id to User model
   */
  public function user($id)
  {
    $game_user = User::find($id);
    $this->page->title = $game_user->name . ' Gaming stream & list';
    if (!$game_user->games->count()) {
      return $this->setContent('gaming::user.no-games', ['game_user' => $game_user]);
    }
    $games = $game_user->games()->wherePivot('status', 'Playing')->with('platforms')->get();
    if (count($games) > 8) {
      $games_sorted = $games->random(8)->sort(function ($a, $b) {
        return strcmp($a->platforms->first()->name, $b->platforms->first()->name);
      });
    } else {
      $games_sorted = $games->sort(function ($a, $b) {
        return strcmp($a->platforms->first()->name, $b->platforms->first()->name);
      });
    }
    $games_grouped = $games_sorted->split(ceil(count($games_sorted) / 4));
    view()->share([
        'layout' => (object)[
          'config' => ['main.class' => 'no-sidebar'],
        ],
        'game_user' => $game_user,
        'games_count' => $games->count(),
        'games_grouped' => $games_grouped,
        'networks' => json_decode(file_get_contents(__DIR__ . '/../../../storage/networks.json')),
      ]
    );

    $this->setContent('gaming::user.index');
  }

  public function index()
  {
    $this->page->title = "Gaming stream & news.";
    $twitch = (new Twitch)->stream();
    $games = User::find(2)->games()->wherePivot('status', 'Playing')->with('platforms')->get();
    $games_sorted = $games->random(8)->sort(function ($a, $b) {
      return strcmp($a->platforms->first()->name, $b->platforms->first()->name);
    });
    $games_grouped = $games_sorted->split(ceil(count($games_sorted) / 4));
    view()->share([
        'layout' => (object)[
          'config' => ['main.class' => 'no-sidebar'],
        ],
        'TwitchStatus' => $twitch->stream ? "online" : "offline",
        'games_count' => $games->count(),
        'games_grouped' => $games_grouped,
        'networks' => json_decode(file_get_contents(__DIR__ . '/../../../storage/networks.json')),
      ]
    );

    $this->setContent('gaming::index');
  }

  public function allGames()
  {
    $this->page->title = "Game list";
    $games = User::find(2)->games()->with('platforms')->get();
    $games_grouped = $games_grouped = $games->groupBy(function ($item, $key) {
      return $item->platforms->first()->name;
    });

    $this->setContent('gaming::all-games', ['games_grouped' => $games_grouped]);
  }


  public function monsterHunter()
  {
    $this->page->title = "Gaming: Monster Hunter";
    view()->share([
      'main.class' => 'no-sidebar',
      'config' => [
        'sb4.content' => view('gaming::game.mh4u-sb4')
      ]
    ]);
    return $this->setContent('gaming::game.monsterhunter', ['wp_posts' => '']);
  }

  public function streamOverlay()
  {
    view()->share([
      'main.class' => 'no-sidebar',
      'config' => [
        'hideNav' => true,
        'hideLogin' => true
      ]
    ]);
    $this->setContent('gaming::stream.overlay');
  }
}