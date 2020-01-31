@extends('web.app')
@section('title','Cara Pesan | ')
@section('description', 'Ini Halaman Cara Pesan')
<link href="{{asset('template/web/css/page.css')}}" rel="stylesheet">
<style>
.input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group {
    margin-right: 70px;
}
  .button-harga {
    background-color: #ffcd1c;
    border: none;
    border-radius: 5px;
    color: black;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.button-harga a{
    text-decoration: none;
}

.button-harga:hover{
  text-decoration: none;
  background-color: #ffcd1c;
  color :black;
}
.button-daftar {
    background-color: #ffffff;
    border: none;
    border-radius: 5px;
    color: #003fef;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.button-daftar a{
    text-decoration: none;
}

.button-daftar:hover{
  text-decoration: none;
  background-color: #ffffff;
  color :#003fef;
}
</style>
@section('content')
<section class="intro">
  <div class="container">
    <h1 style="text-align:center">CARA PESAN</h1>
    <h4 style="text-align:center">Ikuti 5 langkah mudah dibawah ini untuk membeli tutorial di Cilsy</h4>
  </div>
</section>

<section class="timeline">
  <ul>
    <li>
      <div>
        <time>DAFTAR</time> Klik <a href="{{ url('member/signup')}}" target="_blank">Disini</a> untuk membuat akun baru, atau klik <a href="{{ url('member/signin')}}" target="_blank">Login</a> untuk masuk ke akun yang sudah pernah anda buat.
      </div>
    </li>
    <li>
      <div>
        <time>Pilih Tutorial</time> <a href="{{ url('lessons/browse/all')}}" target="_blank">Pilih Judul-judul Tutorial</a> yang Anda inginkan. Klik Beli untuk menambahkan tutorial tersebut ke keranjang pembelian.
      </div>
    </li>
    <li>
      <div>
        <time>Pilih Metode Pembayaran</time> Lihat <a href="{{ url('cart')}}" target="_blank">Keranjang Belanja</a> Anda, lalu Tentukan metode pembayaran yang anda inginkan. Bisa melalui kartu kredit atau bank transfer.
      </div>
    </li>
    <li>
      <div>
        <time>Bayar</time> Lakukan pembayaran sesuai petunjuk dan metode yang anda pilih, tanpa perlu melakukan konfirmasi pembayaran. Lihat petunjuk pembayaran <a href="{{ url('petunjuk')}}" target="_blank">Disini</a> 
      </div>
    </li>
    <li>
      <div>
        <time>Akses Video Tutorial</time> Berhasil, Silahkan Login kembali dan <a href="{{ url('member/dashboard')}}" target="_blank">akses tutorial yang Anda beli</a>.
      </div>
    </li>
  </ul>
</section>
<section class="intro">
  <div class="container">
    <h1>Akses ke semua tutorial sekarang!</h1>
    <a class="btn button-daftar"  href="{{ url('/member/package') }}">Lihat Harga Paket</a>
    <a class="btn button-harga" href="{{ url('/member/signup') }}" >Buat akun sekarang</a>
  </div>
</section>	
<script>
(function() {

  'use strict';

  // define variables
  var items = document.querySelectorAll(".timeline li");

  // check if an element is in viewport
  // http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
  function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  function callbackFunc() {
    for (var i = 0; i < items.length; i++) {
      if (isElementInViewport(items[i])) {
        items[i].classList.add("in-view");
      }
    }
  }

  // listen for events
  window.addEventListener("load", callbackFunc);
  window.addEventListener("resize", callbackFunc);
  window.addEventListener("scroll", callbackFunc);

})();
</script>
@endsection
