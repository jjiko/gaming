<?php

namespace Jiko\Gaming\Models\Multistreamer;

use Illuminate\Database\Eloquent\Model;

class StreamsAccounts extends Model
{
  protected $table = 'streams_accounts';
  protected $connection = 'multistreamer';

  public $guarded = [];

  public $timestamps = false;

}