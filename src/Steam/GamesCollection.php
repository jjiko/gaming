<?php namespace Jiko\Gaming\Steam;

use Illuminate\Database\Eloquent\Collection;

class GamesCollection extends Collection {
  /**
   * Create a new collection.
   *
   * @param  mixed $items
   */
  public function __construct($items = array())
  {
    foreach($items as $index => $item) {
      $items[$index] = new Game($item);
    }

    parent::__construct();
  }
}