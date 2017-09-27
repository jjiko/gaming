<?php

namespace Jiko\Gaming\Listeners;

use Jiko\Gaming\Events\StreamUserCreated;
use Jiko\Gaming\Events\StreamUserLogin;

class StreamEventSubscriber
{

  public function onStreamLive($event)
  {

  }

  public function onUserLogin(StreamUserLogin $event)
  {
    $event->verifyUserExists();
    $event->verifyUserStreams();
  }

  public function onUserCreated(StreamUserCreated $event)
  {
    $event->copyMsUserToLocal();
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param  Illuminate\Events\Dispatcher $events
   */
  public function subscribe($events)
  {

    $events->listen(
      'Jiko\Gaming\Events\StreamUserLogin',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onUserLogin'
    );

    $events->listen(
      'Jiko\Gaming\Events\StreamUserCreated',
      'Jiko\Gaming\Listeners\StreamEventSubscriber@onUserCreated'
    );
  }
}