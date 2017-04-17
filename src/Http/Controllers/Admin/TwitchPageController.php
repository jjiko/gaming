<?php

namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Jiko\Gaming\Twitch\TwitchChannel;

class TwitchPageController extends AdminController
{
  public function index(Request $request)
  {
    if ($twitchUser = $request->user()->twitch) {
      $channel = $twitchUser->channel();
      if ($channel instanceof TwitchChannel) {
        $this->setContent('admin::gaming.twitch.channel', ['channel' => $channel]);
        return;
      }
    }

    // no twitch user or bad request (probably out of scope token)
    return redirect()->route('auth.connect.redirect', ['twitch'])->with('redirectAfter', request()->url());
  }
}