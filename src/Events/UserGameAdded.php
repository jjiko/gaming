<?php

namespace Jiko\Gaming\Events;

use Illuminate\Queue\SerializesModels;
use Jiko\Activity\Traits\Trackable;

class UserGameAdded
{
  use SerializesModels, Trackable;

  public $user_id, $game_id, $attributes;

  public function __construct($user_id, $game_id, Array $attributes)
  {
    $this->user_id = $user_id;
    $this->game_id = $game_id;
    $this->attributes = $attributes;
  }
}