@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <p>管理者機能</p>
          <ul>
            <li><a href="/admin/albums">アルバムの一覧・編集</a></li>
            <li><a href="/admin/albums/create">アルバムの追加</a></li>
          </ul>
          <p>一般ページ</p>
          <ul>
            <li><a href="/albums">アルバムの一覧</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
