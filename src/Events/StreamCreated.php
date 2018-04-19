<?php

namespace Jiko\Gaming\Events;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\SerializesModels;
use Jiko\Activity\Traits\Trackable;

class StreamCreated
{
  use SerializesModels;
  use Trackable {
    registerActivity as protected traitRegisterActivity;
  }

  public $service, $category, $action, $label, $value;

  function __construct($category, $label, Array $value, $action = "created")
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
    // No time limit for create
    $res = array_get($this->value, "raw");
    $vars = [$this->category, $this->action, $this->label, json_encode($res)];
    Artisan::call('errantbot:send', ['message' => vsprintf("ACTIVITY @category=%s;@action=%s;@label=%s;@data=%s;", $vars)]);

    if ($this->label === "jjiko") {

      $me = \Jiko\Auth\User::find(2);
      $res = $me->twitch->status();

      if (!$res->stream) return;

      // Prepare tweet
      $tags = ["Twitch", "Live", "Streaming", "SupportSmallStreamers", "ErrantNights"];
      $message = "📺 Live on #twitchtv   🎮 playing {$res->stream->channel->game}\n\"{$res->stream->channel->status}\" https://jiko.us/twitch ↗️\n.\n.\n.\n";
      foreach ($tags as $tag) {
        $message .= "#{$tag} ";
      }

      // API requires a local file path
      $tmp = tmpfile();
      fwrite($tmp, file_get_contents($res->stream->preview->large));
      $path = stream_get_meta_data($tmp)['uri'];

      // Send it
      Artisan::call('twitter:send', ['message' => $message, 'path' => $path]);

      // Cleanup tmp local file
      fclose($tmp);
    }
  }
}