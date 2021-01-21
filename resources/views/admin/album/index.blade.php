@extends('../layouts/app')
@section('content')
<div class="container">
  <div class="admin-album-index">
    <div class="card">
      <div class="card-header"><h2>アルバム一覧</h2></div>
        <div class="card-body">
          @foreach($albums as $album)
            <table>
              <tbody>
                <tr>
                  <td colspan="3"><span>タイトル</span><br><h3><a class="title-link" href="/albums/{{ $album->id }}">{{ $album->title }}</h3></a></td>
                  <td>写真 {{ count(Storage::disk('s3')->files(getFolderName($album))) }} 枚</td>
                </tr>
                <tr>
                  <td colspan="2">
                    【
                      @if ($album['isPublished'])
                      {{ $album['isGrouped'] ? count($album->users()->get()).'人に公開中' : '全体に公開中' }}
                      @else
                      非公開中
                      @endif
                    】
                  </td>
                  <td><a class="edit-link btn btn-success" href="/admin/albums/{{ $album->id }}/edit"><i class="far fa-edit fa-fw"></i>編集</a></td>
                  <td>
                    <form action="/admin/albums/{{ $album->id }}" method="post" onSubmit="return confirm('本当に削除しますか？保存済みの写真も削除されます。');">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt fa-fw"></i>削除</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr size="10" color="#ccc">
          @endforeach
          <hr size="10" color="#ccc">
          <a href="/admin">管理画面へもどる</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
