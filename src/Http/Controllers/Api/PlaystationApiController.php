<?php namespace Jiko\Gaming\Http\Controllers\Api;

use Jiko\Http\Controllers\Controller as BaseController;
use PSN\Auth;
use PSN\AuthException;
use PSN\User;
use PSN\Trophy;

class PlaystationApiController extends BaseController
{
  protected $user;
  protected $oauthuser;
  protected $tokens;

  function __construct()
  {
    parent::__construct();
  }

  protected function setUser(\Jiko\Auth\User $user)
  {
    $this->oauthuser = $user;
    $tokens = $this->oauthuser->playstation->getTokens();

    // Set user for output
    $this->user = new User($tokens);
    $this->tokens = $tokens;
  }

  protected function getActivity()
  {
    $activity = $this->user->GetUserActivity($this->oauthuser->playstation->getId());

    if (property_exists($activity, "httpStatus") && $activity->httpStatus == 401) {
      try {
        $newTokens = Auth::GrabNewTokens($this->tokens['refresh']);
        $this->tokens['oauth'] = $newTokens['oauth'];
      } catch (AuthException $e) {
        dd($e->GetError());
      }

      // Update OAuth token
      $this->tokens = $this->oauthuser->playstation->updateToken($newTokens['oauth']);
      $this->user = new User($this->tokens);

      return $this->getActivity();
    }

    return $activity;
  }

  public function joejiko()
  {
    $this->setUser(\Jiko\Auth\User::find(2));
    return $this->getActivity();
  }

  public function index()
  {
    $this->setUser(auth()->user());
    $activity = $this->getActivity();
    $trophy = new Trophy($this->tokens);

    return response()->json([
      'me' => $this->user->Me(),
      'activity' => $activity,
      'trophies' => $trophy->getMyTrophies()
    ]);
//    dd($trophy->getMyTrophies());
//    dd($trophy->GetGameTrophies("NPWR11631_00"));

  }

}