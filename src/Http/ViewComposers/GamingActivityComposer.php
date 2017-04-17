<?php

namespace Jiko\Gaming\Http\ViewComposers;

use Illuminate\View\View;
use Jiko\Activity\Activity;

class GamingActivityComposer
{
  function __construct(Activity $activity)
  {
    $this->activities = $activity::gaming()->orderBy('created_at', 'desc')->get();

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