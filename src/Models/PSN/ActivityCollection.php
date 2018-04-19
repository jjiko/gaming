<?php namespace Jiko\Gaming\Models\PSN\Feed;

use Illuminate\Support\Collection;

class ActivityCollection extends Collection
{
  public function __construct($items = [])
  {
    foreach ($items as $item) {

      $this->items[] = new Activity($attributes);
      continue;
    }
  }
}