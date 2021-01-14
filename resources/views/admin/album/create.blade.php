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
              <input class="form-control" type="text" name="title" value="{{ isset($album) ? $album['title'] : '' }}" required>
            </div>
            <div class="form-group">
              <label for="body">コメント</label>
              <textarea class="form-control" name="body" required>{{ isset($album) ? $album['body'] : '' }}</textarea>
            </div>
            <label for="customFile">イベント画像</label>
            <div class="custom-file">
              <label class="custom-file-label" for="customFile">Choose files</label>
              <input class="custom-file-input" id="customFile" type="file" name="files[]" multiple onChange="previewImages(this);" accept="image/x-png, image/jpeg, image/jpg">
            </div>
            <ul id="image-preview-list"></ul>
            <ul id="file-list"></ul>
            <p>公開/非公開</p>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="isPublishedSwitch" name="isPublished" onChange="togglePublished(this);">
              <label id="isPublished--label" class="custom-control-label" for="isPublishedSwitch">非公開</label>
            </div>
            <p>グループ公開/全体公開</p>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="isGroupedSwitch" name="isGrouped" onChange="toggleGrouped(this);" checked disabled>
              <label id="isGrouped--label" class="custom-control-label" for="isGroupedSwitch">グループ公開</label>
            </div>
            <button id="add-new-album-btn" class="btn btn-primary" type="submit">保存</button>
          </form>
          <hr size="10" color="#ccc">
          <a href="/admin">管理画面へもどる</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
