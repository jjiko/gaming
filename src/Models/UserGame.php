<?php namespace Jiko\Gaming\Models;

class UserGame extends GamingModel
{
  protected $table = "user_game";

  public $guarded = ['id'];
}