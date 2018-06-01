<?php

namespace Jiko\Gaming\Commands;

use Illuminate\Console\Command;

use Jiko\Auth\User;
use Jiko\Gaming\Models\Platform;

class GamingUpdateCache extends Command
{
  protected $signature = 'gaming:update-cache';

  protected $description = 'clear and update cached gaming queries';

  public function handle()
  {
    cache()->tags('gaming')->flush();

    cache()->tags('gaming')->rememberForever('me.games', function () {
      return User::find(2)->games()->with('platforms')->get();
    });

    cache()->tags('gaming')->rememberForever('me.games.playing', function() {
      return User::find(2)->games()->wherePivot('status', 'Playing')->with('platforms')->get();
    });

    cache()->tags('gaming')->rememberForever('gaming.platforms', function () {
      return Platform::all();
    });
  }
}