@extends('../layouts/app')
@section('content')
<div class="container">
  <div class="admin-album-edit">
    <div class="card">
      <div class="card-header">アルバムの編集</div>
        <div class="card-body">
          <form action="/admin/albums/{{ $album->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label for="title">イベント名</label>
              <input class="form-control" type="text" name="title" value="{{ $album->title }}">
            </div>
            <div class="form-group">
              <label for="body">コメント</label>
              <textarea class="form-control" type="text" name="body">{!! $album->body !!}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">更新</button>
          </form>
          <hr size="10" color="#ccc">
          <div class="create-images">
            <form action="/admin/images/create" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label for="image">イベント画像</label>
                <input id="file-form" class="form-control-file" type="file" name="files[]" multiple onChange="previewImages(this);" accept="image/x-png, image/gif, image/jpeg">
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
                  <button type="submit" onClick="return deleteImageConfirm();" class="btn btn-danger">削除</button>
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
