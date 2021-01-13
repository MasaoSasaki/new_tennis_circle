<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{
  public function index()
  {
    $images = Storage::disk('s3')->files('material');
    return view('admin/image/index', compact('images'));
  }

  public function store(Request $request)
  {
    Storage::disk('s3')->putFile('material', $request->file('file'), 'public');
    return redirect('admin/images')->with('success', '作成が完了しました。');
  }

  // 外部からのコントロール
  public function createImage(Request $request)
  {
    $id = $request['id'];
    $album = Album::findOrFail($id);
    $albumFolder = preg_replace('/\s+|-|:|/', '', $album->created_at);
    $folderName = getFolderName($album);
    $filePaths = Storage::disk('s3')->files($folderName);
    $fileNames = array();
    forEach($filePaths as $filePath) {
      array_push($fileNames, getFileNameOfFilePath($filePath));
    }

    // 画像が選択されていなかったらreturn
    if (empty($request->file('files'))) {
      return redirect("admin/albums/$id/edit")->with('danger', '画像選択されていません。');
    }

    foreach ($request->file('files') as $image) {
      Storage::disk('s3')->putFile($albumFolder, $image, 'public');
    }
    return redirect("admin/albums/$id/edit")->with('success', '画像を追加保存しました。');
  }

  public function destroyImage(Request $request, $id)
  {
    $album = Album::findOrFail($id);
    $folderName = getFolderName($album);
    $fileName = $request['fileName'];
    Storage::disk('s3')->delete("$folderName/$fileName");
    return redirect("admin/albums/$id/edit")->with('success', '画像を削除しました。');
  }
}
