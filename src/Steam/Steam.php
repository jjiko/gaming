<?php namespace Jiko\Gaming\Steam;

class Steam
{
  public $players;

  public function __construct(array $steamids)
  {
    $this->players = new PlayerCollection($steamids);
  }
}