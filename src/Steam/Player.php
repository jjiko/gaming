<?php namespace Jiko\Gaming\Steam;

use Illuminate\Database\Eloquent\Collection;

class Player
{
  /**
   * 64bit SteamID of the user
   *
   * @var string
   */
  public $steamid;
  public $communityvisibilitystate;
  /**
   * If set, indicates the user has a community profile configured (will be set to '1')
   *
   * @var boolean
   */
  public $profilestate;
  public $personaname;
  /**
   * The last time the user was online, in unix time.
   * @var int
   */
  public $lastlogoff;
  public $commentpermission;
  public $profileurl;
  /**
   * The full URL of the player's 32x32px avatar. If the user hasn't configured an avatar, this will be the default ? avatar.
   *
   * @var string
   */
  public $avatar;
  /**
   * The full URL of the player's 64x64px avatar. If the user hasn't configured an avatar, this will be the default ? avatar.
   *
   * @var string
   */
  public $avatarmedium;
  public $avatarfull;

  /**
   * The user's current status.
   * 0 - Offline,
   * 1 - Online,
   * 2 - Busy,
   * 3 - Away,
   * 4 - Snooze,
   * 5 - looking to trade,
   * 6 - looking to play.
   *
   * If the player's profile is private, this will always be "0", except is the user has set his status to looking to trade or looking to play, because a bug makes those status appear even if the profile is private.
   *
   * @var int
   */
  public $personastate;
  public $realname;
  public $primaryclanid;
  public $timecreated;
  public $personastateflags;

  /**
   * If the user is currently in-game, this will be the name of the game they are playing. This may be the name of a non-Steam game shortcut.
   *
   * @var
   */
  public $gameextrainfo;
  public $gamesowned;
  public $gamesrecentlyplayed;
  public $gameid;
  public $loccountrycode;
  public $locstatecode;

  protected $key;

  function __construct($steamid)
  {
    $this->key = getenv('STEAM_KEY');
    $this->steamid = $steamid;
    $this->summary();
    $this->gamesrecentlyplayed();

    return $this;
  }

  function summary()
  {
    $request = getJson(
      sprintf("%s?%s",
        "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/",
        http_build_query([
          'key' => $this->key,
          'steamids' => $this->steamid
        ])
      ));

    $player = $request->response->players[0];
    foreach ($player as $property_name => $value) {
      if (property_exists($this, $property_name)) {
        $this->{$property_name} = $value;
      }
    }
  }

  function gamesrecentlyplayed()
  {
    if (empty($this->gamesrecentlyplayed)) {
      $request = getJson(
        sprintf("%s?%s",
          "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/",
          http_build_query([
            'key' => $this->key,
            'steamid' => $this->steamid,
            'format' => 'json'
          ])
        )
      );

      if(property_exists($request->response, "total_count")) {
        if($request->response->total_count > 0) {
          $gamesrecentlyplayed = new GamesCollection($request->response->games);
          foreach ($request->response->games as $game) {
            $gamesrecentlyplayed->add(new Game($game));
          }
          $this->gamesrecentlyplayed = $gamesrecentlyplayed;
        }
      }
    }

    return $this;
  }

  function gamesowned()
  {
    if (empty($this->gamesowned)) {
      $request = getJson(
        sprintf("%s?%s",
          "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/",
          http_build_query([
            'key' => $this->key,
            'steamid' => $this->steamid,
            'include_appinfo' => true
          ])
        ));

      $this->gamesowned = new Collection($request->response->games);
    }

    return $this->gamesowned;
  }

  function personastatename()
  {
    $personaStateNames = [
      0 => 'offline',
      1 => 'online',
      2 => 'busy',
      3 => 'away',
      4 => 'snooze',
      5 => 'looking to trade',
      6 => 'looking to play'
    ];
    return $personaStateNames[$this->personastate];
  }
}