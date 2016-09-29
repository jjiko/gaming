<?php namespace Jiko\Gaming\Steam;

use Illuminate\Database\Eloquent\Collection;

class PlayerCollection extends Collection {
  /**
   * Create a new collection.
   *
   * @param  mixed $items
   */
  public function __construct($items = array())
  {
    foreach($items as $index => $steamid) {
      $items[$index] = new Player($steamid);
    }

    $items = is_null($items) ? [] : $this->getArrayableItems($items);

    $this->items = (array) $items;
  }
}