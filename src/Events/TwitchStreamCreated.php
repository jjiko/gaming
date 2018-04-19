<?php

namespace Jiko\Gaming\Events;

class TwitchStreamCreated extends StreamCreated
{
  public $raw;

  protected $service = "Twitch";

  function __construct($channel, \stdClass $res, $lastEventTimestamp = null)
  {
    $attributes = [
      "raw" => $res,
      "lastEventTimestamp" => $lastEventTimestamp !== null ? $lastEventTimestamp : time(),
      "channelUrl" => $res->stream->channel->url,
      "currentViewers" => $res->stream->viewers,
      "created_at" => $res->stream->created_at,
      "updated_at" => $res->stream->channel->updated_at,
      "game" => str_replace(":", "", $res->stream->channel->game),
      "streamPreview" => $res->stream->preview->large
    ];

    parent::__construct($this->service, $channel, $attributes);
  }
}