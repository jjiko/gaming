<?php namespace Jiko\Gaming\Models;

use Illuminate\Database\Eloquent\Collection;

class Platform extends GamingModel
{
  protected $table = 'platform';

  public $guarded = ['id'];

  public function game()
  {
    return $this->belongsToMany('Jiko\Gaming\Models\Game', 'game_platform', 'platform_id', 'game_id');
  }

  public function user()
  {
    return $this->belongsToMany('Jiko\Auth\User', 'user_game', 'user_id', 'platform_id');
  }

  public function getImageAttribute($value)
  {
    return (new Collection(json_decode($value) ?: []));
  }
}