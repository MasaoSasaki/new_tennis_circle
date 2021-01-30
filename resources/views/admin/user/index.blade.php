@extends('../layouts/app')
@section('content')
<div class="container admin-user-index">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">ユーザー一覧</div>
        <div class="card-body">
          <p>[非表示]にすると、<u>全体公開</u>のアルバムも表示されなくなります。</p>
          <ul>
            @foreach($users as $index => $user)
              <li>
                <p>{{ $user['last_name'].' '.$user['first_name'] }}</p>
                <form class="radio-form{{ $index }}">
                  @csrf
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="publicUser_{{ $user['id'] }}" name="user_{{ $user['id'] }}isPublished" class="custom-control-input" onChange="postIsPublishedData(this)" {{ $user->isPublished ? 'checked' : '' }}>
                    <label class="custom-control-label" for="publicUser_{{ $user['id'] }}">表示</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="privateUser_{{ $user['id'] }}" name="user_{{ $user['id'] }}isPublished" class="custom-control-input" onChange="postIsPublishedData(this)" {{ $user->isPublished ? '' : 'checked' }}>
                    <label class="custom-control-label" for="privateUser_{{ $user['id'] }}">非表示</label>
                  </div>
                </form>
              </li>
            @endforeach
          </ul>
          <hr size="10" color="#ccc">
          <div class="albums-link"><a href="/admin">管理者画面へもどる</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
