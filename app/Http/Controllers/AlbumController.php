<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
  public function index()
  {
    $user = User::find(Auth::id());
    if ($user['isPublished']) {
      $privateAlbums = $user->albums()->where('isPublished', true)->get();
      $publicAlbums = Album::where('isPublished', true)->where('isGrouped', false)->get();
      $albums = collect($publicAlbums->merge($privateAlbums))->sortByDesc('created_at');
      forEach($albums as $album) {
        $albumFolder = preg_replace('/\s+|-|:|/', '', $album->created_at);
        $album['images'] = Storage::disk('s3')->files($albumFolder);
      }
    } else {
      $albums = [];
    }
    return view('album/index', compact('albums', 'user'));
  }

  public function show($id)
  {
    $album = Album::findOrFail($id);
    $images = Storage::disk('s3')->files(getFolderName($album));
    shuffle($images);
    return view('album/show', compact('images', 'album'));
  }
}
