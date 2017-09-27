<?php

namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Jiko\Auth\OAuthUser;
use Jiko\Gaming\Events\StreamUserLogin;
use GuzzleHttp\Client;

class StreamConsoleController extends AdminController
{
  public $multistreamer;

  protected $layout = 'admin::layouts.default';

  public function __construct()
  {
    $client = new Client();

    // get config URLS
    $res = $client->request('GET', 'http://192.168.86.105:8081/api/v1/config', [
      'headers' => [
        'Authorization' => 'Bearer ' . getenv('MULTISTREAMER_TOKEN'),
        'Accept' => 'application/json'
      ]
    ]);
    $this->multistreamer = (object)['config' => json_decode($res->getbody())];

    parent::__construct();
  }

  public function index()
  {
    // dashboard
    event(new StreamUserLogin($this->user));

    $multistreamer = $this->user->multistreamer;
    $stream = $multistreamer->user->streams()->default()->first();
    //dd($stream);

    //dd($this->user->twitch->channel());
    $oauthChannels = OAuthUser::where('user_id', $this->user->id)->whereIn('provider', ['twitch', 'google'])->get();
    $viewData = [
      'channels' => $multistreamer->user->channels,
      'ms_config' => $this->multistreamer->config,
      'stream' => $stream
    ];

    return $this->content('admin::streaming.dashboard', $viewData);
  }

  public function alerts()
  {
    // alerts (social, ts3, discord)
  }

  public function history()
  {
    // stream history
  }

  public function chat()
  {
    // irc
  }
}