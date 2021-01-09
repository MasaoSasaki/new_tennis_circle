<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
  public function index()
  {
    $albums = Album::all();
    forEach($albums as $album) {
      $albumFolder = preg_replace('/\s+|-|:|/', '', $album->created_at);
      $album['images'] = Storage::disk('s3')->files($albumFolder);
    }
    return view('album/index', compact('albums'));
  }

  public function show($id)
  {
    $album = Album::findOrFail($id);
    $images = Storage::disk('s3')->files(getFolderName($album));
    return view('album/show', compact('images', 'album'));
  }
}
