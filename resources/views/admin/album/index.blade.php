@extends('../layouts/app')
@section('content')
<div class="container">
  <div class="admin-album-index">
    <div class="card">
      <div class="card-header">アルバム一覧</div>
        <div class="card-body">
          <ul>
            @foreach($albums as $album)
            <li>
              <a class="title-link" href="/albums/{{ $album->id }}">{{ $album->title }}</a>
              <a class="edit-link" href="/admin/albums/{{ $album->id }}/edit"><i class="far fa-edit fa-fw"></i></a>
              <form action="/admin/albums/{{ $album->id }}" method="post">
                @csrf
                {{ method_field('delete') }}
                <button type="submit" onClick="return deleteConfirm();"><i class="far fa-trash-alt fa-fw"></i></button>
              </form>
            </li>
            @endforeach
          </ul>
          <hr size="10" color="#ccc">
          <a href="/admin/home">管理画面へもどる</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
