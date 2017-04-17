<?php

namespace Jiko\Gaming\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class GamingEventServiceProvider extends ServiceProvider
{
  protected $subscribe = [
    'Jiko\Gaming\Listeners\UserGameEventSubscriber',
  ];
}