<?php

namespace Jiko\Gaming\Listeners;

use Jiko\Gaming\Events\StreamCreated;
use Jiko\Gaming\Events\StreamStreaming;

class StreamEventSubscriber
{

  /**
   * @param $event
   * Live stream detected
   */
  public function onStreamCreated(StreamCreated $event)
  {
    $event->registerActivity();
    $event->announce();
  }

  public function onStreamStreaming(StreamStreaming $event)
  {
    $event->registerActivity();
    $event->announce();
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param  Illuminate\Events\Dispatcher $events
   */
  public function subscribe($events)
  {

    $events->listen(
      'Jiko\Gaming\Events\TwitchStreamCreated',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onStreamCreated'
    );

    $events->listen(
      'Jiko\Gaming\Events\TwitchStreamStreaming',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onStreamStreaming'
    );

    $events->listen(
      'Jiko\Gaming\Events\StreamCreated',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onStreamCreated'
    );

    $events->listen(
      'Jiko\Gaming\Events\StreamStreaming',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onStreamStreaming'
    );
  }
}