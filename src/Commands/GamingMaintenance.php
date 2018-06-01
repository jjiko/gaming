<?php

namespace Jiko\Gaming\Commands;

use Illuminate\Console\Command;
use Jiko\Gaming\Models\Game;

class GamingMaintenance extends Command
{
  protected $signature = 'gaming:maintenance';

  protected $description = 'db maintenance';

  public function handle()
  {
    $games = Game::all();
    foreach($games as $game) {

    }
  }
}