<?php

namespace Jiko\Gaming\Models\Multistreamer;

use Illuminate\Database\Eloquent\Model;

class Webhooks extends Model
{
  protected $table = 'webhooks';
  protected $connection = 'multistreamer';

}