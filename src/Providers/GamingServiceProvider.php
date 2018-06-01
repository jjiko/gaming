<?php

namespace Jiko\Gaming\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;
use Jiko\Gaming\Commands\Gaming;
use Jiko\Gaming\Commands\GamingUpdateCache;
use Jiko\Gaming\Commands\Multistreamer;
use Jiko\Gaming\Commands\StreamCheckLive;
use Jiko\Gaming\Models\Game;
use Jiko\Gaming\Models\UserGame;
use Jiko\Gaming\Observers\GameObserver;
use DirectoryIterator;

class GamingServiceProvider extends ServiceProvider
{
  public function boot()
  {
    parent::boot();

    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'gaming');
    $this->loadViewsFrom(__DIR__ . '/../resources/views/admin', 'admin');

    if ($this->app->runningInConsole()) {
      $this->commands([
        Gaming::class,
        GamingUpdateCache::class,
        Multistreamer::class,
        StreamCheckLive::class
      ]);
    }

    Game::observe(GameObserver::class);
    UserGame::observe(GameObserver::class);

    View::composer(
      'gaming::index', 'Jiko\Gaming\Http\ViewComposers\GamingComposer'
    );

    View::composer(
      'gaming::activities', 'Jiko\Gaming\Http\ViewComposers\GamingActivityComposer'
    );

    View::composer(
      'gaming::activities-widget', 'Jiko\Gaming\Http\ViewComposers\GamingActivityWidgetComposer'
    );
  }

  public function register()
  {
    $this->app->register('Jiko\Gaming\Providers\GamingEventServiceProvider');
  }

  protected function loadRoutesFromDir($routes_path, $recursive = false)
  {
    foreach (new DirectoryIterator($routes_path) as $file) {
      if (!$file->isDot() && !$file->isDir() && ($file->getExtension() === 'php')) {
        require_once $routes_path . DIRECTORY_SEPARATOR . $file->getFilename();
      }
    }
  }

  public function map()
  {
    #if (!$this->app->routesAreCached()) {
    $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
    $this->loadRoutesFromDir(__DIR__ . '/../Http/routes/');
    #}
  }
}