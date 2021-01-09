<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ImageController as AdminImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
})->name('root');

Route::group(['middleware' => 'auth'], function() {
  Route::resource('admin/albums', AdminAlbumController::class)->except(['show']);
  Route::get('admin/home', [AdminHomeController::class, 'index']);
  Route::resource('admin/images', AdminImageController::class)->only(['index', 'store']);
  Route::post('admin/images/create', [AdminImageController::class, 'createImage']);
  Route::post('admin/images/{id}', [AdminImageController::class, 'destroyImage']);
});

Route::group(['middleware' => 'basicauth'], function() {
  Route::resource('albums', AlbumController::class)->only(['index', 'show']);
});

Auth::routes();

