<?php namespace Jiko\Gaming\Http\Controllers\Admin;

use Jiko\Admin\Http\Controllers\AdminController;
use Jiko\Gaming\Models\Platform;

class PlatformPageController extends AdminController
{
  /**
   * @param $id
   */
  public function show($id)
  {

  }

  public function update($id)
  {
    $model = Platform::find($id);
    $images = $model->images;
    $images->put('logo_url', request()->input('logo_url'));

    // @todo add to system events
    $model->update(['images' => $images->toJson()]);

    return redirect()->back();
  }
}