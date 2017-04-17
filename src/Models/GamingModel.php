<?php namespace Jiko\Gaming\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Jiko\Database\Eloquent\Relations\BelongsToMany;

class GamingModel extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  function __construct(array $attributes = [])
  {
    $this->connection = 'j5';

    parent::__construct($attributes);
  }
}