<?php

namespace Jiko\Gaming\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class Multistreamer extends Command
{
  protected $signature = 'multistreamer:subscribe';

  protected $description = 'Subscribe to multistreamer Redis channels';

  public function handle()
  {
    Redis::connection('multistreamer')->psubscribe(['*'], function ($message, $channel) {
      Log::info("Message: $message, Channel: $channel");
      echo sprintf("%s: %s\n", $channel, $message);
    });
  }
}