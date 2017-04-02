<?php namespace Jiko\Gaming\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  protected $table = 'game';

  public $guarded = ['id'];

  public function platforms()
  {
    return $this->belongsToMany('Jiko\Gaming\Models\Platform');
  }

  public function users()
  {
    return $this->belongsToMany('Jiko\Auth\User');
  }

  public function getImageAttribute($value)
  {
    return (new Collection(json_decode($value) ?: []));
  }

  public function scopeLive($query)
  {
    return $query->where('live', true);
  }
}