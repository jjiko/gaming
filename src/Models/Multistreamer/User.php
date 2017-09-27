<?php

namespace Jiko\Gaming\Models\Multistreamer;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';
  protected $connection = 'multistreamer';
  public $guarded = [];

  public function setAccessTokenAttribute()
  {
    $this->attributes['access_token'] = substr(strtoupper(md5(floor(1 + rand() * 60))), 20);
  }

  public function streams()
  {
    return $this->hasMany('Jiko\Gaming\Models\Multistreamer\Streams');
  }

  public function channels()
  {
    return $this->hasMany('Jiko\Gaming\Models\Multistreamer\Accounts');
  }
}