<?php

namespace Jiko\Gaming\Listeners;

class UserGameEventSubscriber
{
  public function onUserGameAdded($event)
  {
    $event->registerActivity(
      'UserGame',
      'added',
      $event->user_id,
      [
        'id' => [
          'game_id' => $event->game_id,
          'platform_id' => $event->platform_id
        ],
        'attributes' => [
          'status' => $event->attributes['status']
        ]
      ]);
  }

  public function onUserGameRemoved($event)
  {
    $event->registerActivity(
      'UserGame', 'removed', $event->user_id,
      ['ids' => $event->game_ids]
    );
  }

  public function onUserGameLive($event)
  {
    $event->registerActivity(
      'UserGame', 'live', $event->user_id,
      ['id' => ['game_id' => $event->game_id, 'platform_id' => $event->platform_id], 'attributes' => $event->attributes]
    );
  }

  public function onUserGameUpdated($event)
  {
    $event->registerActivity(
      'UserGame', 'updated', $event->user_id,
      ['id' => ['game_id' => $event->game_id, 'platform_id' => $event->platform_id], 'attributes' => $event->attributes]
    );
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param  Illuminate\Events\Dispatcher $events
   */
  public function subscribe($events)
  {
    $events->listen(
      'Jiko\Gaming\Events\UserGameAdded',
      'Jiko\Gaming\Listeners\UserGameEventSubscriber@onUserGameAdded'
    );

    $events->listen(
      'Jiko\Gaming\Events\UserGameRemoved',
      'Jiko\Gaming\Listeners\UserGameEventSubscriber@onUserGameRemoved'
    );

    $events->listen(
      'Jiko\Gaming\Events\UserGameUpdated',
      'Jiko\Gaming\Listeners\UserGameEventSubscriber@onUserGameUpdated'
    );
  }

}