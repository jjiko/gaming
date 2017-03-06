<?php namespace Jiko\Gaming\Http\Controllers\Page;

use Jiko\Http\Controllers\Controller;
use Jiko\Gaming\Twitch\Twitch;

class GamingPageController extends Controller
{
  public function index()
  {
    $this->page->title = "Gaming stream & news.";
    $twitch = (new Twitch)->stream();
    view()->share([
        'layout' => (object)[
          'config' => ['main.class' => 'no-sidebar'],
        ],
        'TwitchStatus' => $twitch->stream ? "online" : "offline",
        'networks' => json_decode(file_get_contents(__DIR__ .'/../../../storage/networks.json'))
      ]
    );

    $this->setContent('gaming::index');
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