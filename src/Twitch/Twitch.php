<?php namespace Jiko\Gaming\Twitch;

use Illuminate\Database\Eloquent\Model;

class Twitch extends Model {

  public $stream;
  protected $client_id;

  public function __construct()
  {
    $this->client_id = getenv('TWITCH_CLIENT_ID');

    parent::__construct();
  }

  public function stream($user="jjiko")
  {
    $streamUrl = sprintf("https://api.twitch.tv/kraken/streams/%s?client_id=%s", $user, $this->client_id);
    if(!$stream = getJson($streamUrl)) {
      return null;
    }

    return $stream;
  }
}