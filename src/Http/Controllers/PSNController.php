<?php namespace Jiko\Gaming\Http\Controllers;

use Jiko\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Gumer\PSN\Http\Connection;
use Gumer\PSN\Authentication\Manager;
use Gumer\PSN\Authentication\UserProvider;
use Gumer\PSN\Requests\GetMyInfoRequest;
use Gumer\PSN\Requests\ProfileRequest;
use Gumer\PSN\Requests\TrophyDataRequest;

class PSNController extends Controller
{

  public function register()
  {
    // @todo register a psn user
    // All encrypted values are encrypted using OpenSSL and the AES-256-CBC cipher. Furthermore, all encrypted values are signed with a message authentication code (MAC) to detect any modifications to the encrypted string.
    // Crypt::encrypt($secret)
    // Crypt::decrypt($encryptedValue); DecryptException
  }
  public function profile($id)
  {
    $client = new Client(['redirect.disable' => true]);
    $connection = new Connection;
    $connection->setGuzzle($client);
    $provider = new UserProvider($connection);
    $auth = Manager::instance($provider);
    $auth->attempt(getenv('PSN_USER'), getenv('PSN_PASSWORD'));

    $request = new GetMyInfoRequest;
    $response = $connection->call($request);
    $info = json_decode($response->getBody(true), true);

    $request = new ProfileRequest;
    $request->setUserId($id);
    $response = $connection->call($request);
    $profile = json_decode($response->getBody(true), true);

    return array_merge($info, $profile);

  }

  public function trophies($id)
  {
    // Gets the ID owner's trophy (first 100) information and returns the JSON object.
    $client = new Client(['redirect.disable' => true]);
    $connection = new Connection;
    $connection->setGuzzle($client);

    $request = new TrophyDataRequest;
    $request->setUserId($id);
    $response = $connection->call($request);
    $trophies = json_decode($response->getBody(true), true);

    return $trophies;
  }

  public function trophiesByGame($id, $npCommID)
  {
    // Gets the ID owner's trophies for the given game title including all DLC's

  }

}