@extends('web.app')
@section('title',$bca->title)
@section('description', $bca->deskripsi)
@section('content')
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('template/web/css/landing.css') }}" rel="stylesheet">
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
{{--  <link href="{{ asset('template/web/css/bootstrap4.min.css') }}" rel="stylesheet">  --}}
<style>
  .fa-play-circle{
    color: #2BA8E2;
  }
  .close-icon {
    webkit-appearance: none;
    appearance: none;
    position: absolute;
    top: -15px;
    right: -15px;
    width: 35px;
    height: 35px;
    color: #fff;
    font-size: 14px;
    background: #222;
    border: none;
    outline: none;
    border-radius: 50%;
    cursor: pointer;
    vertical-align: middle;
    z-index :100;
  }
  .sidebar-box {
    max-height: 200px;
    position: relative;
    overflow: hidden;
  }
  .sidebar-box .read-more { 
    position: absolute; 
    bottom: -5px; 
    left: 0;
    width: 100%; 
    text-align: left; 
    margin: 0; 
    background-color: white;
  }
</style>
  <section class="header">
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 col-xs-12">
          <a href="{{ url('bootcamp/'.$bca->slug.'/courseSylabus/') }}" class="btn-tag">{{$bca->title}}</a>
          
          <h1 class="price">Rp. {{$bca->price}} </h1>
          <h2>{{$bca->title}}</h2>
         
          <h6 class="mb-4">Oleh {{$contributors->username}}, Created at {{ $tanggal }} </h6>
          <a id="#" href="# " class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>        
          <button id="beli-{{ $bca->id }}" class="btn btn-lg btn-primary mb-2" onclick="addToCartBootcamp({{ $bca->id }})">Tambah ke Keranjang</button>
        </div>
      </div>
    </div>
  </section>
  @endsection