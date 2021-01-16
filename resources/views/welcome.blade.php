@extends('../layouts/app')
@section('content')
<div class="welcome">
  @if( Auth::check() )
    <a class="btn btn-primary" href="/albums">アルバムの一覧へ</a>
  @else
    <a class="btn btn-primary" href="/login">メンバーログイン</a>
    <p>または</p>
    <a class="btn btn-success" href="/register">新規登録</a>
  @endif
</div>
@endsection
