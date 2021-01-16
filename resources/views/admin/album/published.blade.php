<span id="js-getNames" data-names="{{ json_encode($names) }}"></span>
<p>公開/非公開</p>
<div class="custom-control custom-switch published-switch">
  <input type="checkbox" class="custom-control-input" id="isPublishedSwitch" name="isPublished" onChange="togglePublished(this);" {{ $album->isPublished ? 'checked' : '' }}>
  <label id="isPublished--label" class="custom-control-label" for="isPublishedSwitch">{{ $album->isPublished ? '公開' : '非公開' }}</label>
</div>
<p>グループ公開/全体公開</p>
<div class="custom-control custom-switch grouped-switch">
  <input type="checkbox" class="custom-control-input" id="isGroupedSwitch" name="isGrouped" onChange="toggleGrouped(this);" {{ $album->isGrouped ? 'checked' : '' }} {{ $album->isPublished ? '' : 'disabled' }}>
  <label id="isGrouped--label" class="custom-control-label" for="isGroupedSwitch">
    {{ $album->isGrouped ? 'グループ公開' : '全体公開' }}
    @if(request()->is('*/create'))
      <span class="warning-message">（現在"非公開"になっています。）<span>
    @else
      @if(!$album->isPublished)
        <span class="warning-message">（現在"非公開"になっています。）<span>
      @endif
    @endif
  </label>
</div>
<div class="form-group create-member-field">
  <label for="name">公開するユーザーを入力</label>
  <input id="name" class="form-control" type="text" list="names" onBlur="addNames();">
  <a class="btn btn-light" onClick="addNames(this);">追加</a>
  <datalist id="names">
    @foreach($names as $index => $name)
      <option value="{{ $name }}">
      <!-- 5人まで候補を表示 -->
      @if ($index === 5)
        @break
      @endif
    @endforeach
  </datalist>
  <span class="error-message"></span>
</div>
