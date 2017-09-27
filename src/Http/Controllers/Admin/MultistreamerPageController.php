<?php

namespace Jiko\Gaming\Http\Controllers\Admin;

use Illuminate\Support\Collection;
use Jiko\Admin\Http\Controllers\AdminController;
use Jiko\Gaming\Models\Multistreamer\User;
use GuzzleHttp\Client;

class MultistreamerPageController extends AdminController
{
  protected $layout = 'admin::layouts.default';

  public function index()
  {
    $client = new Client();

    // get config URLS
    $res = $client->request('GET', 'http://192.168.86.105:8081/api/v1/config', [
      'headers' => [
        'Authorization' => 'Bearer ' . getenv('MULTISTREAMER_TOKEN'),
        'Accept' => 'application/json'
      ]
    ]);
    $ms_config = json_decode($res->getbody());

    $user = User::where('email', auth()->user()->email)->first();

    // get all streams for account
    $streams = $user->streams;

    // get status of all streams
    $statuses = new Collection();
    foreach ($streams as $stream) {
      $status = $client->request('PATCH', 'http://192.168.86.105:8081/api/v1/stream/' . $stream->id, [
        'headers' => [
          'Authorization' => 'Bearer ' . getenv('MULTISTREAMER_TOKEN'),
          'Accept' => 'application/json'
        ]
      ]);
      $statuses->push([$stream->id => json_decode($status->getBody())]);
    }

    $data = [
      'user' => $user,
      'stream' => $streams->first(),
      'statuses' => $statuses,
      'channels' => $user->channels,
      'ms_config' => $ms_config
    ];
    return $this->content('admin::multistreamer.index', $data);
  }
}
