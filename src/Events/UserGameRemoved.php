<?php

namespace Jiko\Gaming\Events;

use Illuminate\Queue\SerializesModels;
use Jiko\Activity\Traits\Trackable;

class UserGameRemoved
{
  use SerializesModels, Trackable;

  public $user_id, $game_ids;

  public function __construct($user_id, $game_ids)
  {
    $this->user_id = $user;
    $this->game_ids = $game_ids;
  }
}