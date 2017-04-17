<?php

namespace Jiko\Gaming\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;
use Jiko\Gaming\Models\Game;
use Jiko\Gaming\Models\UserGame;
use Jiko\Gaming\Observers\GameObserver;


class GamingServiceProvider extends ServiceProvider
{
  public function boot()
  {
    parent::boot();

    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'gaming');
    $this->loadViewsFrom(__DIR__ . '/../resources/views/admin', 'admin');

    Game::observe(GameObserver::class);
    UserGame::observe(GameObserver::class);

    View::composer(
      'gaming::index', 'Jiko\Gaming\Http\ViewComposers\GamingComposer'
    );

    View::composer(
      'gaming::activities', 'Jiko\Gaming\Http\ViewComposers\GamingActivityComposer'
    );
  }

  public function register()
  {
    $this->app->register('Jiko\Gaming\Providers\GamingEventServiceProvider');
  }

  public function map()
  {
    #if (!$this->app->routesAreCached()) {
    require_once(__DIR__ . '/../Http/routes.php');
    #}
  }
}