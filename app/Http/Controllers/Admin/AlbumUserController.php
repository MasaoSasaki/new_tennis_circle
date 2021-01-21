<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlbumUser;

class AlbumUserController extends Controller
{
  public function destroy(Request $request)
  {
    $album = $request['album'];
    AlbumUser::where('album_id', $album)->where('user_id', $request['user'])->delete();
    return redirect("admin/albums/$album/edit")->with('success', 'ユーザーをアルバムから外しました。');
  }
}
