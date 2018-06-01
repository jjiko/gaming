<?php

namespace Jiko\Gaming\Http\ViewComposers;

use Illuminate\View\View;
use Jiko\Activity\Activity;

class GamingActivityWidgetComposer
{
  function __construct()
  {
    $this->activities = cache()->rememberForever('activity.widget', function(){
      return Activity::gaming()->orderBy('created_at', 'desc')->limit(8)->get();
    });
  }

  function compose(View $view)
  {
    $view->with([
      'activities' => $this->activities,
    ]);
  }
}