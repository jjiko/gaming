<?php

namespace Jiko\Gaming\Models\Multistreamer;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
  protected $table = 'accounts';
  protected $connection = 'multistreamer';

  public function keystore()
  {
    return Keystore::where('account_id', $this->id)->get();
  }
}