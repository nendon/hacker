@extends('contrib.home.app')
@section('title','Cilsy Fiolution | Contributor')
@section('content')
<div id="top-section-wrapper">
        <div id="top-section">
            <p>
                Bagikan ilmu anda ke ribuan orang dan dapatkan penghasilan tambahan hingga jutaan rupiah. Selamanya
            </p>
            <div class="row">
                <div class="col-md-6 col-md-push-1">
                    <a href="{{ url('contributor/register')}}" class="top-section-btn">Menjadi contributor</a>
                </div>
                <div class="col-md-6 col-md-pull-1">
                    <a href="{{ url('contributor/skema') }}" target="_blank" class="top-section-btn">Panduan contributor</a>
                </div>
            </div>

        </div>
    </div>

    <div id="icon-row">
        <div class="container">
        <div class="row">
                <div class="item col-md-3 col-sm-6">
                    <img src="{{asset('template/home_contributor/img/3.png')}}" class="icon-img" alt="">
                    <p class="icon-title">Penghasilan<br>Terbaik</p>
                    <p class="icon-desc">Skema bagi hasil 70:30 bulanan yang menguntungkan anda</p>
                </div>
                <div class="item col-md-3 col-sm-6">
                    <img src="{{asset('template/home_contributor/img/1.png')}}" class="icon-img" alt="">
                    <p class="icon-title">Online dan<br>Global</p>
                    <p class="icon-desc">Cilsy membantu anda menemukan ribuan murid di seluruh indonesia</p>
                </div>
                <div class="item col-md-3 col-sm-6">
                    <img src="{{asset('template/home_contributor/img/2.png')}}" class="icon-img" alt="">
                    <p class="icon-title">Mengajar sekali,<br>Manfaat ribuan kali</p>
                    <p class="icon-desc">Tutorial yang anda buat bisa bertahan selamanya, dan pendapatan tetap anda dapatkan</p>
                </div>
                <div class="item col-md-3 col-sm-6">
                    <img src="{{asset('template/home_contributor/img/4.png')}}" class="icon-img" alt="">
                    <p class="icon-title">Tidak pakai<br>ribet</p>
                    <p class="icon-desc">Anda cukup membuat tutorial. Cilsy akan menangani seperti customer service, semua marketing, pembayaran, dan yang lainnya</p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ url('contributor/register')}}" class="mulai-mengajar-btn">
       Mulai Mengajar Online
    </a>

@endsection()