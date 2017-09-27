<?php

namespace Jiko\Gaming\Events;

use Illuminate\Queue\SerializesModels;
use Jiko\Gaming\Models\Multistreamer\User;
use Jiko\Gaming\Models\Multistreamer\Streams;
use Jiko\Gaming\Models\Multistreamer\StreamsAccounts;

class StreamUserLogin
{
  use SerializesModels;

  function __construct($user)
  {
    $this->user = $user;
  }

  public function createMSUser()
  {
    // Create a new account in Multistreamer DB
    if ($msf_user = User::where('email', $this->user->email)->first()) {

    } else {
      // @note sql: substr(upper(md5(FLOOR(1+RAND()*60))) from 21)
      $msf_user = User::create([
        'access_token' => null,
        'username' => $this->user->email,
        'email' => $this->user->email
      ]);

      event(new StreamUserCreated($this->user, $msf_user));
    }
  }

  public function verifyUserExists()
  {
    if (!$this->user->multistreamer) {
      if ($this->user->email) {
        $this->createMSUser();
      }
    }
  }

  public function verifyUserStreams()
  {
    if($this->user->multistreamer) {
      // Default Stream
      if (!$this->stream = Streams::where('user_id', $this->user->multistreamer->oauth_id)->where('name', 'Default')->first()) {
        $this->stream = Streams::create([
          'user_id' => $this->user->multistreamer->oauth_id,
          'uuid' => null,
          'name' => 'Default',
          'slug' => 'default',
          'preview_required' => 1
        ]);
      }

      // @todo make sure stream has at least one network/channel attached to it
//      if (!$linked = StreamsAccounts::where('stream_id', $this->stream->id)->where('account_id', $this->user->multistreamer->oauth_id)->first()) {
//        StreamsAccounts::create([
//          'stream_id' => $this->stream->id,
//          'account_id' => $this->user->multistreamer->oauth_id
//        ]);
//      }
    }
  }
}