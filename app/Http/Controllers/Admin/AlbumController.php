<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\User;
use App\Models\AlbumUser;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
  public function index()
  {
    $albums = Album::orderBy('created_at', 'desc')->get();
    return view('admin/album/index', compact('albums'));
  }

  public function create()
  {
    $album = new Album();
    $names = array();
    forEach(User::all() as $user) {
      array_push($names, $user['last_name'].' '.$user['first_name']);
    }
    return view('admin/album/create', compact('album', 'names'));
  }

  public function store(Request $request)
  {
    // アルバムの新規保存
    $album = new Album;
    $album['title'] = $request['title'];
    $album['body'] = $request['body'];
    $album['isPublished'] = isset($request['isPublished']) ? true : false;
    $album->save();

    // アルバムに紐づくユーザーの保存
    if (isset($request['isGrouped']) && !$request['names'] == null) {
      forEach($request['names'] as $requestName) {
        forEach(User::all() as $index => $user) {
          if ($requestName === $user['last_name'].' '.$user['first_name']) {
            $albumUser = new AlbumUser();
            $albumUser['album_id'] = $album['id'];
            $albumUser['user_id'] = $user['id'];
            $albumUser->save();
          }
        }
      }
    }

    // アルバムに紐づく写真の保存
    if($request->file('files')) {
      $albumFolder = preg_replace('/\s+|-|:|/', '', $album->created_at);
      forEach($request->file('files') as $image) {
        Storage::disk('s3')->putFile($albumFolder, $image, 'public');
      }
    }

    return redirect('admin/albums')->with('success', '作成が完了しました。');
  }

  public function edit($id)
  {
    $album = Album::findOrFail($id);
    $folderName = getFolderName($album);
    $filePaths = Storage::disk('s3')->files($folderName);
    $fileNames = array();
    forEach($filePaths as $filePath) {
      array_push($fileNames, getFileNameOfFilePath($filePath));
    }
    $names = array();
    forEach(User::all() as $user) {
      array_push($names, $user['last_name'].' '.$user['first_name']);
    }
    $albumUsers = AlbumUser::where('album_id', $id)->get();
    $users = User::all();
    return view('admin/album/edit', compact('fileNames', 'album', 'folderName', 'names', 'albumUsers', 'users'));
  }

  public function update(Request $request, $id)
  {
    // アルバム情報の更新
    $album = Album::findOrFail($id);
    $album['title'] = $request['title'];
    $album['body'] = $request['body'];
    $album['isPublished'] = isset($request['isPublished']) ? true : false;
    $album['isGrouped'] = isset($request['isGrouped']) ? true : false;
    $album->save();

    // アルバムに紐づくユーザーの更新
    if (isset($request['isGrouped']) && !$request['names'] == null) {
      forEach($request['names'] as $requestName) {
        forEach(User::all() as $index => $user) {
          if ($requestName === $user['last_name'].' '.$user['first_name']) {
            $albumUser = new AlbumUser();
            $albumUser['album_id'] = $album['id'];
            $albumUser['user_id'] = $user['id'];
            if (AlbumUser::where('album_id', $album['id'])->where('user_id', $user['id'])->exists()) { break; }
            $albumUser->save();
          }
        }
      }
    }

    return redirect('admin/albums')->with('success', '更新が完了しました。');
  }

  public function destroy($id)
  {
    $album = Album::findOrFail($id);
    $albumFolder = preg_replace('/\s+|-|:|/', '', $album->created_at);
    Storage::disk('s3')->deleteDirectory($albumFolder);
    $album->delete();
    return redirect('admin/albums')->with('success', '削除が完了しました。');
  }
}
