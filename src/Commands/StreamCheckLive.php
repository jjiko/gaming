<?php

namespace Jiko\Gaming\Commands;

use Illuminate\Console\Command;

use Jiko\Activity\Activity;
use Jiko\Gaming\Events\TwitchStreamCreated;
use Jiko\Gaming\Events\TwitchStreamStreaming;


class StreamCheckLive extends Command
{
  protected $signature = 'stream:check-live {type=all} {--test}';

  protected $description = 'Check for live streams';

  public function handle()
  {
    if ($this->option("test") === true) {
      $this->info("Running stream:check-live in test mode");
    }
    // @todo check other stream types
    // Check for live twitch streams
    $channels = ['jjiko', 'vashton'];

    foreach ($channels as $channel) {
      $res = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/$channel?client_id=" . env("TWITCH_CLIENT_ID")));
      if (!$res->stream) {
        $this->info("No live streams.");
        continue;
      }

      // Check for recent events
      $lastEvent = Activity::where('category', "TwitchStream")
        ->where('label', $channel)
        ->whereBetween("created_at", [
          (new \Carbon\Carbon("-6 hours"))->toDateTimeString(),
          (new \Carbon\Carbon())->toDateTimeString()
        ])
        ->orderBy('created_at', 'desc')
        ->first();

      if ($lastEvent) {
        event(new TwitchStreamStreaming($channel, $res, $lastEvent->created_at->timestamp));
        continue;
      }

      // If no previous event in the past X hours (Treat this as a new stream)
      $this->info("(no previous events) Fire StreamCreated event ${channel}");
      event(new TwitchStreamCreated($channel, $res));
    }

    return ['twitch' => [null]];
  }
}