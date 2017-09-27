<?php

namespace Jiko\Gaming\Models\Multistreamer;

use Illuminate\Database\Eloquent\Model;

class Streams extends Model
{
  protected $table = 'streams';
  protected $connection = 'multistreamer';

  public $guarded = [];

  public function setUuidAttribute()
  {
    if (function_exists("random_bytes")) {
      $data = random_bytes(16);
    } else {
      $data = openssl_random_pseudo_bytes(16);
    }
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    $this->attributes['uuid'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  public function user()
  {
    return $this->belongsTo('Jiko\Gaming\Models\Multistreamer\User');
  }

  public function accounts()
  {
    return $this->belongsToMany('Jiko\Gaming\Models\Multistreamer\Accounts', 'streams_accounts', 'stream_id', 'account_id');
  }

  public function keystore()
  {
    return Keystore::where('stream_id', $this->stream_id)->whereNull('account_id')->get();
  }

  public function scopeDefault($query, $type = 'Default')
  {
    return $query->where('name', $type);
  }
}