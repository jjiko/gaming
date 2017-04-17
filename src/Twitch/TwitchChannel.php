<?php

namespace Jiko\Gaming\Twitch;

class TwitchChannel
{
  function __construct($attributes = [])
  {
    foreach ($attributes as $k => $v) {
      $this->{$k} = $v;
    }
  }

  public function stream_key_hidden() {
    $segments = explode('_', $this->stream_key);
    $segments[2] = str_repeat("*", strlen($segments[2]));
    return implode('_', $segments);
  }

  public function find($id)
  {

  }
}