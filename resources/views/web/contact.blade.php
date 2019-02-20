@extends('web.app')
@section('title','Contact')
@section('description', 'Ini Halaman Contact Cilsy')
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
        <h3>Kontak</h3>
        <p class="content center">
        Apabila anda memiliki pertanyaan, kritik, saran apapun seputar layanan Cilsy dapat menghubungi

kontak berikut :<br>

<b>Email : halo@cilsy.id </b><br>

<b>Whatsapp : 089630713487</b><br>
<b>Alamat : Jl. Dr. Djundjunan No 169 RT 002 RW 002 Kel Husein Sastranegara Kec Cicendo Bandung</b>
        </p>
      </div>
    </div>
  </div>

</div>

@endsection
