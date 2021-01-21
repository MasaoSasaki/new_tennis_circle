<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function feedback()
  {
    return view('/home/feedback');
  }

  public function privacy_policy()
  {
    return view('/home/privacy-policy');
  }

  public function terms()
  {
    return view('/home/terms');
  }
}
