@extends('web.app')
@section('title','Tentang')
@section('description','Ini Halaman Tentang')
@section('content')
<style media="screen">
  .section-content{
    min-height: 350px;
    padding-top: 50px;
  }
  .section-content h3{
    font-weight: 700;
    color: #777;
    letter-spacing: 2px;
    text-align: center;
  }
  .section-content .content{
    color: #777;
    letter-spacing: 1px;
    line-height: 1.5;
    margin: 25px 0px;
    text-align: justify;
  }
</style>
<div class="section-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>Tentang</h3>
        <p class="content">
        Cilsy adalah layanan online video tutorial eksklusif IT dengan dengan chat & email support yang dapat

membantu orang-orang lebih cepat jago di bidang IT. Seluruh video dan modul yang ada benar-
benar original, berbahasa indonesia, dan buatan sendiri oleh para pakar dan kontributor di Cilsy.

Saat ini sudah ada lebih dari 200 modul video di bidang networking dan server yang dapat

dinikmati. Kedepannya keseluruhan materi IT baik itu dibidang programming, cloud, elektronika,

hingga desain grafis juga ada.
        </p>
      </div>
    </div>
  </div>

</div>

@endsection
