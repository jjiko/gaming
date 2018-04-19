<?php namespace Jiko\Gaming\Models;

use Illuminate\Database\Eloquent\Collection;

class Game extends GamingModel
{
  public $guarded = ['id'];
  protected $table = 'game';
  protected $with = ['platforms'];
//  protected $casts = [
//    'image' => 'array'
//  ];

  public function platforms()
  {
    return $this->belongsToMany('Jiko\Gaming\Models\Platform');
  }

  public function users()
  {
    return $this->belongsToMany('Jiko\Auth\User');
  }

  public function getCoverAttribute()
  {
    if($this->image->has('local_cover_url')) {
      return $this->image->get('local_cover_url');
    }

    return $this->image->get('super_url');
  }

  public function getImageAttribute($value)
  {
    if (is_array($value)) {
      return (new Collection($value));
    }

    return (new Collection(json_decode($value) ?: []));
  }

  public function scopeLive($query)
  {
    return $query->where('live', true);
  }
}