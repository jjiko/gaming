<?php

namespace Jiko\Gaming\Observers;

use Illuminate\Database\Eloquent\Model;
use Jiko\Activity\Traits\Trackable;

class GameObserver
{
  use Trackable;

  public function created(Model $model)
  {
    $this->registerActivity('Game', 'created', $model->name, ['id' => $model->id]);
  }

  public function updated(Model $model)
  {
    $this->registerActivity('Game', 'updated', $model->name, ['id' => $model->id]);
  }

  public function deleted(Model $model)
  {
    $this->registerActivity('Game', 'deleted', $model->name, ['id' => $model->id]);
  }
}