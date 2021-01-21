@extends('../layouts/app')
@section('content')
<div class="container home-feedback">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>不具合について</h2></a></div>
        <div class="card-body">
          <p>利用中に不具合や、操作で不明なところがありましたら下記までご連絡ください。</p>
          <ul>
            <li><a href="{{ config('app.contact_line') }}">LINE</a></li>
            <li><a href="mailto:{{ config('app.contact_email') }}">メール</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
