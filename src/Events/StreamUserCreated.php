<?php

namespace Jiko\Gaming\Events;

use Illuminate\Queue\SerializesModels;

use Jiko\Auth\OAuthUser;
use Jiko\Auth\User;
use Jiko\Gaming\Models\Multistreamer\User as MSUser;

class StreamUserCreated
{
  use SerializesModels;

  public $user, $msuser, $stream;

  function __construct(User $user, MSUser $msuser)
  {
    $this->user = $user;
    $this->msuser = $msuser;
  }

  public function copyMsUserToLocal()
  {
    if (!$this->user->multistreamer) {
      OAuthUser::create([
        'user_id' => $this->msuser->id,
        'token' => $this->msuser->access_token,
        'provider' => 'multistreamer',
        'oauth_id' => $this->msuser->id
      ]);
    }
  }
}