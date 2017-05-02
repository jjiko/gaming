<?php

namespace Jiko\Gaming\Events;

use Illuminate\Queue\SerializesModels;
use Jiko\Activity\Traits\Trackable;

class UserGameLive
{
  use SerializesModels, Trackable;

  public $user_id, $game_id, $platform_id, $attributes = [];

  public function __construct($user_id, $game, $attributes)
  {
    $this->user_id = $user_id;
    $this->game_id = $game['game_id'];
    $this->platform_id = $game['platform_id'];
    $this->attributes = $attributes;
  }
}