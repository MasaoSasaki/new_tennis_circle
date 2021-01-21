@extends('../layouts/app')
@section('content')
<div class="container">
  <div class="admin-album-edit">
    <div class="card">
      <div class="card-header">アルバムの編集</div>
        <div class="card-body">
          <form action="/admin/albums/{{ $album['id'] }}" method="post" enctype="multipart/form-data" class="edit-album">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label for="title">イベント名</label>
              <input class="form-control" type="text" name="title" value="{{ $album->title }}" required>
            </div>
            <div class="form-group">
              <label for="body">コメント</label>
              <textarea class="form-control" name="body" required>{!! $album->body !!}</textarea>
            </div>
            @include('admin.album.published')
            <button class="btn btn-primary" type="submit">更新</button>
          </form>
          <hr size="10" color="#ccc">
          <div class="album-users">
            <p>現在公開済みのユーザー</p>
            <ul>
              @foreach($album['users'] as $user)
                <li>
                  <p>{{ $user['last_name'].' '.$user['first_name'] }}</p>
                  <form action="/admin/album_user" method="post" enctype="multipart/form-data" onSubmit="return confirm('外してよろしいですか？')">
                    @csrf
                    {{ method_field('delete') }}
                    <input type="hidden" name="album" value="{{ $album['id'] }}">
                    <input type="hidden" name="user" value="{{ $user['id'] }}">
                    <button type="submit" class="btn btn-danger">外す</button>
                  </form>
                </li>
              @endforeach
            </ul>
          </div>
          <hr size="10" color="#ccc">
          <div class="create-images">
            <form action="/admin/images/create" method="post" enctype="multipart/form-data">
            @csrf
              <label for="customFile">写真を追加する</label>
              <div class="custom-file">
                <label class="custom-file-label" for="customFile">Choose files</label>
                <input class="custom-file-input" id="customFile" type="file" name="files[]" multiple onChange="previewImages(this);" accept="image/x-png, image/jpeg, image/jpg">
              </div>
              <ul id="image-preview-list"></ul>
              <ul id="file-list"></ul>
              <input type="hidden" name="id" value="{{ $album['id'] }}">
              <button id="add-new-album-btn" class="btn btn-primary" type="submit">追加保存</button>
            </form>
          </div>
          <hr size="10" color="#ccc">
          <div class="delete-images">
            <p>現在保存されている画像</p>
            <ul>
              @foreach($fileNames as $fileName)
              <li>
                <img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $folderName }}/{{ $fileName }}" alt="">
                <form action="/admin/images/{{ $album['id'] }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="fileName" value="{{ $fileName }}">
                  <button type="submit" onClick="return deleteConfirm();" class="btn btn-danger">削除</button>
                </form>
              </li>
              @endforeach
            </ul>
          </div>
          <hr size="10" color="#ccc">
          <a href="/admin/albums">一覧へもどる</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
