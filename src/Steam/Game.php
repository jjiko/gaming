<?php namespace Jiko\Gaming\Steam;

class Game {
  public $appid;
  public $name;
  public $playtime_2weeks;
  public $playtime_forever;
  public $img_icon_url;
  public $img_logo_url;

  function __construct(\stdClass $properties)
  {
    foreach($properties as $prop_name => $value)
    {
      if(property_exists($this, $prop_name)) {
        $this->{$prop_name} = $value;
      }
    }
  }
}