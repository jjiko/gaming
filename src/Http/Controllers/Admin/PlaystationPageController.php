<?php namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;


class PlaystationPageController extends AdminController
{
  public function setup() {

  }

  public function login() {
    try {
      $account = new Auth(request()->input('login'), request()->input('password'), request()->input('ticket_uuid'), request()->input('2fa'));
    }
    catch (AuthException $e) {
      header("Content-Type: application/json");
      die($e->GetError());
    }

    dd($account->GetTokens());

    // @todo store in oauth_users
  }
}