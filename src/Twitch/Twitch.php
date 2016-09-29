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

  public function stream($user="joejiko")
  {
    if(!$stream = getJson("https://api.twitch.tv/kraken/streams/$user?client_id=$this->client_id")) {
      return null;
    }

    return $stream;
  }
}