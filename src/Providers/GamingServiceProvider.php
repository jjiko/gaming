<?php

namespace Jiko\Gaming\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Jiko\Auth\User;

class GamingServiceProvider extends ServiceProvider
{
  public function boot()
  {
    parent::boot();

    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'gaming');
    $this->loadViewsFrom(__DIR__ . '/../resources/views/admin', 'admin');
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