<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Cilsy Fiolution | Contributor</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('template/home_contributor/img/logo-only.png')}}"/>
    <link href="{{asset('template/home_contributor/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/home_contributor/css/custom.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('template/home_contributor/js/jquery.min.js')}}"></script>
    <style>
    #sign-container {
    margin: auto;
    margin-top: 50px;
    margin-bottom: 50px;
    max-height: 800px;
    width: 95%;
    max-width: 554px;
    border-radius: 10px;
    background-color: #f8f8f8;
    overflow: hidden;
    }
    </style>
</head>

<body>
    <div id="header">
        <div class="container">
            <div class="logo-container">
                <a href="{{url('contributor/')}}">
                    <img class="logo" src="{{asset('template/web/img/logo.png')}}"></img>
                </a>
            </div>
            <div class="header-right pull-right">
                <a href="{{ url('contributor/register')}}" class="kontributor-btn">Menjadi Contributor</a>
                <a href="{{ url('contributor/skema') }}" target="_blank" class="panduan-kontributor-btn">Panduan Contributor</a>
            </div>
        </div>
    </div>
            @yield('content')

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <img class="footer-logo" src="{{asset('template/home_contributor/img/logo-only.png')}}" alt=""></img>
                    <span class="footer-logo-text">Cilsy</span>
                    <p>
                        Adalah platform tutorial jaringan dan server online yang memudahkan semua
                        orang yang ingin belajar dan berdiskusi dengan ahli.
                    </p>
                    <p class="copyrigth-text">
                        Copyright Cilsy Fiolution 2016-2017
                    </p>
                </div>
                <div class="col-md-2">

                  <?=Helper::pageMenu();?>

                </div>
                <div class="col-md-2 col-xs-4">
                    <ul class="nav-footer">
                        <li>Ikuti Kami</li>
                        <li><a href="https://www.facebook.com/cilsyfiolution/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/cilsyfiolution/">Instagram</a></li>
                        <li><a href="#">Line</a></li>
                        <li><a href="#">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-xs-4">
                    <ul class="nav-footer">
                        <li>Bantuan</li>
                        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                        <li><a href="{{ url('/kebijakan') }}">Kebijakan Layanan</a></li>
                        <li><a href="{{ url('/carapesan') }}">Cara Pesan & Berlangganan</a></li>
                        <li><a href="{{ url('member/package') }}">Harga & Perbandingan Paket</a></li>
                        <li><a href="{{ url('/petunjuk') }}">Petunjuk Pembayaran</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('https://blog.cilsy.id') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <p class="copyrigth-text">
                        Sarijadi Blok 23, No. 80, Kota Bandung
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{asset('template/home_contributor/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/home_contributor/js/custom.js')}}"></script>
</body>

</html>
