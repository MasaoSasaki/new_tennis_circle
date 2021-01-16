@extends('../layouts/app')
@section('content')
<div class="container album-show">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>{{ $album->title }}</h2></div>
        <div class="card-body">
          <div class="comments">
            <p>コメント：</p>
            {!! nl2br($album->body) !!}
          </div>
          <div class="images">
            <ul>
              @foreach($images as $image)
              <li><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $image }}" alt=""  onClick="showModal(this);"></li>
              @endforeach
            </ul>
          </div>
          <div class="modal-window" onClick="hideModal();">
            <div class="modal-content">
              <i class="fas fa-times fa-3x" onClick="hideModal();"></i>
              <img src="" alt="" class="modal-image">
            </div>
            <!-- <div class="arrows">
              <i class="fas fa-arrow-circle-left fa-3x fa-inverse"></i>
              <i class="fas fa-arrow-circle-right fa-3x fa-inverse"></i>
            </div> -->
          </div>
          <div class="albums-link"><a href="/albums">アルバム一覧へもどる</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
