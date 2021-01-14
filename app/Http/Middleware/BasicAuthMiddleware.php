<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      switch (true) {
        case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
        // case $_SERVER['PHP_AUTH_USER'] !== config('app.basic_auth_user'):
        case $_SERVER['PHP_AUTH_PW']   !== config('app.basic_auth_pw'):
          header('WWW-Authenticate: Basic realm="Enter username and password."');
          header('Content-Type: text/plain; charset=utf-8');
          die('このページを見るにはログインが必要です');
      }
      header('Content-Type: text/html; charset=utf-8');
      return $next($request);
    }
}
