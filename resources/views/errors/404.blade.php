@extends('web.app')
@section('content')
<title>Cilsy - 404 Page Not Found !</title>
<style media="screen">
@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
    }
}

  .section-content h1{
    font-weight: 700;
    color: #777;
    letter-spacing: 2px;
  }
  .section-content .content{
    color: #777;
    letter-spacing: 1px;
    line-height: 1.5;
    margin: 25px 0px;
  }
</style>
<div class="section-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center ">
        <h1>404</h1>
        <p class="content">Halaman tidak ditemukan!</p>
        <a href="{{ url('/') }}" class="btn btn-info">Kembali ke halaman utama</a>
      </div>
    </div>
  </div>

</div>

@endsection
