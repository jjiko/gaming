<?php namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Jiko\Gaming\Models\Game;

class GamePageController extends AdminController
{
  /**
   * @param $id
   */
  public function show($id)
  {
    $game = Game::find($id);
    $this->page->title = 'Show Game Page';
    $this->setContent('admin::gaming.game.show');
  }
}