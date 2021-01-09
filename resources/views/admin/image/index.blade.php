@extends('../layouts/app')
@section('content')
<div class="container admin-image-index">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>保存されている画像一覧</h2></div>
        <div class="card-body">
          <div class="images">
            @foreach($images as $image)
              <img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $image }}" alt="">
            @endforeach
          </div>
          <hr size="10" color="#ccc">
          <div class="create-images">
            <form action="/admin/images" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label for="image">イベント画像</label>
                <input id="file-form" class="form-control-file" type="file" name="file" accept="image/x-png, image/gif, image/jpeg">
              </div>
              <ul id="image-preview-list"></ul>
              <button id="add-new-album-btn" class="btn btn-primary" type="submit">追加保存</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
