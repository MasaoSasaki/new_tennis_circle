@extends('../layouts/app')
@section('content')
<div class="container">
  <div class="admin-album-create">
    <div class="card">
      <div class="card-header">アルバムの新規作成</div>
        <div class="card-body">
          <form action="/admin/albums" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="title">イベント名</label>
              <input class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
              <label for="body">コメント</label>
              <textarea class="form-control" name="body"></textarea>
            </div>
            <div class="form-group">
              <label for="image">イベント画像</label>
              <input id="file-form" class="form-control-file" type="file" name="files[]" multiple onChange="previewImages(this);"　accept="image/x-png,　image/gif,　image/jpeg">
            </div>
            <ul id="image-preview-list"></ul>
            <ul id="file-list"></ul>
            <button id="add-new-album-btn" class="btn btn-primary" type="submit">保存</button>
          </form>
          <hr size="10" color="#ccc">
          <a href="/admin/home">管理画面へもどる</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
