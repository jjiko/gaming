<?php namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Jiko\Gaming\Models\Game;
use Illuminate\Support\Facades\Input;

class GamePageController extends AdminController
{
  /**
   * @param $id
   */
  public function show($id)
  {
    $game = request()->user()->games()->find($id);
    $this->setContent('admin::gaming.game.show', ['game' => $game]);
  }

  public function update($id)
  {
    $game = Game::find($id);
    $images = $game->image;
    $images->put('local_cover_url', Input::get('local_cover_url'));

    $result = $game->update(['image' => $images->toJson()]);
    return $game;
  }
}