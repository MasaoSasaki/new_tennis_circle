@extends('../layouts/app')
@section('content')
<div class="container album-show">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>{{ $album->title }}</h2></div>
        <div class="card-body">
          <div class="albums">
            @foreach($images as $image)
            <img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $image }}" alt="">
            @endforeach
          </div>
          <div class="comments">
            <p>コメント：</p>
            {!! nl2br($album->body) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
