<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view('admin/user/index', compact('users'));
  }

  public function privateUser($id)
  {
    $user = User::find($id);
    $user['isPublished'] = false;
    $user->save();
  }

  public function publicUser($id)
  {
    $user = User::find($id);
    $user['isPublished'] = true;
    $user->save();
  }
}
