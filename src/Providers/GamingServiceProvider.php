<?php

namespace Jiko\Gaming\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class GamingServiceProvider extends ServiceProvider
{
  public function boot()
  {
    parent::boot();

    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'gaming');
  }

  public function register()
  {
  }

  public function map()
  {
    #if (!$this->app->routesAreCached()) {
    require_once(__DIR__ . '/../Http/routes.php');
    #}
  }
}