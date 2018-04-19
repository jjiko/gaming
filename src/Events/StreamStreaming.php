<?php

namespace Jiko\Gaming\Events;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\SerializesModels;
use Jiko\Activity\Traits\Trackable;

class StreamStreaming
{
  use SerializesModels;
  use Trackable {
    registerActivity as protected traitRegisterActivity;
  }

  public $service, $category, $action, $label, $value;

  public function __construct($category, $label, Array $value, $action = "created")
  {
    $this->service = $category;
    $this->category = ucfirst($category) . "Stream";
    $this->action = $action;
    $this->label = $label;
    $this->value = $value;
  }

  public function registerActivity()
  {
    $this->traitRegisterActivity($this->category, $this->action, $this->label, $this->value);
  }

  public function announce()
  {
    if(app()->runningInConsole()) {
      echo "Check for announcements..";
    }
    $lastEventTimestamp = array_get($this->value, "lastEventTimestamp");

    // Announce to discord every 2 hours
    if (strtotime("-2 hours") >= $lastEventTimestamp) {
      $vars = [$this->category, $this->action, $this->label, json_encode($this->value)];
      Artisan::call('errantbot:send', ['message' => vsprintf("ACTIVITY @category=%s;@action=%s;@label=%s;@data=%s;", $vars)]);
    }

    // Announce to twitter every 30 minutes
    if (strtotime("-30 minutes") >= $lastEventTimestamp) {
      // @todo remove hard-coded channel name
      if ($this->action === "jjiko") {

        $me = \Jiko\Auth\User::find(2);
        $res = $me->twitch->status();

        if (!$res->stream) return;

        // Prepare tweet
        $tags = ["Twitch", "Live", "Streaming", "SupportSmallStreamers", "ErrantNights"];
        $message = "📺 Live on #twitchtv   🎮 playing {$res->stream->channel->game}\n\"{$res->stream->channel->status}\" https://jiko.us/twitch ↗️\n.\n.\n.\n";
        foreach ($tags as $tag) {
          $message .= "#{$tag} ";
        }

        $tmp = tmpfile();
        fwrite($tmp, file_get_contents($res->stream->preview->large));
        $path = stream_get_meta_data($tmp)['uri'];

        // Send it
        Artisan::call('twitter:send', ['message' => $message, 'path' => $path]);

        fclose($tmp);
      }
    }
  }
}