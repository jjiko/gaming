<?php namespace Jiko\Gaming\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GiantBombApiController extends Controller
{
  function __construct()
  {
    $this->user_agent = 'Jiko API UA';
    $this->parameters = [
      'api_key' => getenv('GIANT_BOMB_API'),
      'format' => 'json',
    ];
  }

  protected function request($endpoint, $options = [])
  {
    //$url = '?api_key=' . getenv('GIANT_BOMB_API') . '&filter=id:' . $id . '&format=json';
    $url = vsprintf('%endpoint$s?%query$s', [
      'endpoint' => $endpoint,
      'query' => http_build_query(array_merge($this->parameters, $options))
    ]);
    $context = stream_context_create(['http' => ['user_agent' => $this->user_agent]]);
    $response = json_decode(file_get_contents($url, false, $context));
    return response()->json($response);
  }

  public function game($id)
  {
    $options = [
      'filter' => "id:$id"
    ];
    return $this->request("http://www.giantbomb.com/api/games", $options);
  }

  public function games()
  {
    $url = 'http://www.giantbomb.com/api/search?api_key=' . getenv('GIANT_BOMB_API') . '&resources=game&query=' . urlencode(Input::get('query')) . '&format=json';
    $context = stream_context_create(['http' => ['user_agent' => 'Jiko API UA']]);
    $response = json_decode(file_get_contents($url, false, $context));
    return response()->json($response);
  }

  public function platform($id)
  {
    $url = 'http://www.giantbomb.com/api/platforms?api_key=' . getenv('GIANT_BOMB_API') . '&filter=id:' . $id . '&format=json';
    $context = stream_context_create(['http' => ['user_agent' => 'Jiko API UA']]);
    $response = json_decode(file_get_contents($url, false, $context));
    return response()->json($response);
  }

  public function platforms()
  {
    $url = 'http://www.giantbomb.com/api/platforms?api_key=' . getenv('GIANT_BOMB_API') . '&format=json';
    $context = stream_context_create(['http' => ['user_agent' => 'Jiko API UA']]);
    $response = json_decode(file_get_contents($url, false, $context));
    return response()->json($response);
  }
}