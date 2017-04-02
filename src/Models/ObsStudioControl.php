<?php namespace Jiko\Gaming\Models;

use WebSocket\Client;

class ObsStudioControl
{
  function __construct()
  {
    $this->client = new Client("ws://localhost:4444");
  }

  public function getInfo()
  {
    $this->client->send(json_encode(['request-type' => 'GetStreamingStatus', 'message-id' => md5(rand())]));
    return json_decode($this->client->receive());
  }

  public function recordStart()
  {
    return $this->getInfo();
  }

  public function recordStop()
  {
    return $this->getInfo();
  }

  public function streamStop()
  {
    $info = $this->getInfo();
    if ($info->getData()->streaming) {
      // toggle streaming
      $this->client->send(json_encode(['request-type' => 'StartStopStreaming', 'message-id' => md5(rand())]));
      return response()->json(json_decode($this->client->receive()));
    }

    return $info;
  }

  public function streamStart()
  {
    $info = $this->getInfo();
    if (!$info->getData()->streaming) {
      // toggle streaming
      $this->client->send(json_encode(['request-type' => 'StartStopStreaming', 'message-id' => md5(rand())]));
      return response()->json(json_decode($this->client->receive()));
    }

    return $info;
  }
}