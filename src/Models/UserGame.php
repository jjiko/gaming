<?php namespace Jiko\Gaming\Models;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
  protected $table = "user_game";

  public $guarded = ['id'];
}