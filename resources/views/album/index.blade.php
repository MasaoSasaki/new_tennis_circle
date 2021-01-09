@extends('../layouts/app')
@section('content')
<div class="container album-index">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach($albums as $album)
        <div class="card">
          <div class="card-header"><a href="/albums/{{ $album->id }}"><h2>{{ $album->title }}</h2></a></div>
          <div class="card-body">
            <a href="/albums/{{ $album->id }}">
              <div class="images">
                <ul>
                  @if(count($album['images']) >= 3)
                    @foreach(array_rand($album['images'], 3) as $index => $image)
                      <li class="li-{{ $index }}"><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $album['images'][$image] }}" alt=""></li>
                    @endforeach
                  </ul>
                  <span>写真:{{ count($album['images']) }}枚</span>
                  @elseif(count($album['images']) >= 2)
                    @foreach(array_rand($album['images'], 2) as $index => $image)
                      <li class="li-{{ $index }}"><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $album['images'][$image] }}" alt=""></li>
                    @endforeach
                  </ul>
                  <span>写真:{{ count($album['images']) }}枚</span>
                  @elseif(count($album['images']) === 1)
                    <li style="text-align: center;"><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/{{ $album['images'][array_rand($album['images'])] }}" alt=""><li>
                  </ul>
                  @else
                    <li style="text-align: center;"><img src="https://tennis-circle.s3.ap-northeast-1.amazonaws.com/material/wRvHCVugSkJG2TyjblP70oAZwwL5LKxHfTZ9YQmp.png" alt=""></li>
                @endif
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
