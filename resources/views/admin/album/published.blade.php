<span id="js-getNames" data-names="{{ json_encode($names) }}"></span>
<div class="custom-control custom-switch published-switch">
  <p>公開/非公開</p>
  <input type="checkbox" class="custom-control-input" id="isPublishedSwitch" name="isPublished" onChange="togglePublished(this);" {{ $album->isPublished ? 'checked' : '' }}>
  <label id="isPublished--label" class="custom-control-label" for="isPublishedSwitch">{{ $album->isPublished ? '公開' : '非公開' }}</label>
</div>
@if ($album->idPublished)
<div class="grouped hide">
@else
<div class="grouped">
@endif
  <div class="custom-control custom-switch grouped-switch">
    <p>グループ公開/全体公開</p>
    <input type="checkbox" class="custom-control-input" id="isGroupedSwitch" name="isGrouped" onChange="toggleGrouped(this);" {{ $album->isGrouped || request()->is('*/create') ? 'checked' : '' }}>
    <label id="isGrouped--label" class="custom-control-label" for="isGroupedSwitch">
      {{ $album->isGrouped || request()->is('*/create') ? 'グループ公開' : '全体公開' }}<br>
    </label>
  </div>
  <div class="form-group create-member-field {{ request()->is('*/create') || $album->isGrouped ? '' : 'hide' }}">
    <label for="name">公開したいユーザーを入力</label>
    <input id="name" class="form-control" type="text" list="names" onBlur="addNames();" onFocus="{this.value = ''}">
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
    <span>公開するユーザー：</span>
    <span class="error-message"></span><br>
  </div>
</div>
