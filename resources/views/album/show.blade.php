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
              <li><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $image }}" alt=""></li>
              @endforeach
            </ul>
          </div>
          <div class="albums-link"><a href="/albums">アルバム一覧へもどる</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
