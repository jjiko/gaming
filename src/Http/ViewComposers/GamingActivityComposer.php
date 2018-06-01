<?php

namespace Jiko\Gaming\Http\ViewComposers;

use Illuminate\View\View;
use Jiko\Activity\Activity;

class GamingActivityComposer
{
  protected $activities;

  function __construct()
  {
    $this->activities = cache()->remember('me.activity.gaming', 360, function () {
      return Activity::gaming()->orderBy('created_at', 'desc')->get();
    });

//    view()->share(['config' => [
//      'main.class' => 'no-sidebar',
//      'sb4.content' => view('gaming::sb4')
//    ]]);
  }

  function compose(View $view)
  {
    $view->with([
      'activities' => $this->activities,
    ]);
  }
}