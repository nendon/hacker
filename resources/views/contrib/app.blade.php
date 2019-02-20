<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Cilsy Fiolution | Contributor</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('template/kontributor/img/logo-only.png')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('template/kontributor/css/bootstrap-3.3.7.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('template/web/css/venobox.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="{{asset('template/kontributor/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/spacing.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/ply.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/dropify.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/jquery.dm-uploader.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/sweetalert.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" type="text/css" />

    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/web/js/venobox.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

    <style>
        .num {
        position: absolute;
        right: 11px;
        top: 6px;
        color: #fff;
        }
        .grayscale { filter: grayscale(100%); }
        .badge-cart {
  background-color: red;
  border-radius: 10px;
  color: white;
  display: inline-block;
  font-size: 12px;
  line-height: 1;
  padding: 3px 7px;
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  margin-left: 30px;
  margin-top: -75px;
}
    </style>
</head>

<body>
    <div id="header">
        <div class="container">
            <img src="{{asset('template/web/img/logo.png')}}" class="logo" alt="">

            <div class="header-menu">
                <ul>
                    <li>
                        <span class="hello-user">Halo, {{ Auth::guard('contributors')->user()->first_name }} </span>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="" class="icon">
                        <?php if(totalnotif() != null){ ?>
                        <span class="badge-cart"><?php echo totalnotif();?></span>
                        <?php } ?>
                        <div class="dropdown-container">
                            <ul>
                              <?php echo notif();?> 
                              <li role="separator" class="divider"></li>
                              <li><a href="{{ url('/contributor/notif')}}">Lihat Semua Pemberitahuan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="has-dropdown">
                    @if(Helper::contrib('avatar') != null)
                    <img src="<?=Helper::contrib('avatar');?>" class="poto img-circle" alt="" style="">
                    @else
                    <img src="{{asset(profilcon())}}" class="poto img-circle" alt="" style="">
                    @endif
                        <div class="dropdown-container">
                            <ul>
                                <li>
                                    <a href="{{ url('contributor/skema') }}">
                                        Panduan Kontributor
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('contributor/logout')}}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            {{--  <div id="app">  --}}
                    @yield('content')
            {{--  </div>  --}}
            
        </div>
    </div>

    @yield('breadcumbs')


    <div id="sidebar">
        <div class="menu-wrapper">
            <a href="#" class="menu-icon">
                <img src="{{asset('template/kontributor/img/icon/Menu.png')}}" alt="" />
            </a>
        </div>

        <ul>

            <li class="{{ request()->is('contributor/dashboard') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a href="{{ url('contributor/dashboard') }}">
                    <img src="{{asset('template/kontributor/img/icon/Home.png')}}" alt="" />
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('contributor/income') ? 'icon-active' : '' || request()->is('contributor/income/*') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Kelola Pendapatan">
                <a href="{{url('contributor/income')}}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Pendapatan.png')}}" alt="" />
                    <span>Kelola Pendapatan</span>
                </a>
            </li>
            <li class="{{ request()->is('contributor/lessons') ? 'icon-active' : '' || request()->is('contributor/lessons/*') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Kelola Tutorial">
                <a href="{{ url('contributor/lessons') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Tutorial</span>
                </a>
            </li>
            <li class="#" data-toggle="tooltip" data-placement="right" title="Kelola Tutorial">
                <a href="">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Siswa</span>
                </a>
            </li>
            <li class="#" data-toggle="tooltip" data-placement="right" title="Kelola Tutorial">
                <a href="{{ url('contributor/prohress') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Progress Siswa</span>
                </a>
            </li>
            <li class="#" data-toggle="tooltip" data-placement="right" title="Kelola Tutorial">
                <a href="{{ url('contributor/project') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Project</span>
                </a>
            </li>
            <li class="{{ request()->is('contributor/comments') ? 'icon-active' : '' || request()->is('contributor/comments/*') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Kelola Pertanyaan">
                <a href="{{ url('contributor/comments') }}">
                    <img src="{{asset('template/kontributor/img/icon/KelolaPertanyaan.png')}}" alt="" />
                    <span>Kelola Pertanyaan</span>
                </a>
            </li>
            <li class="{{ request()->is('contributor/comments') ? 'icon-active' : '' || request()->is('contributor/comments/*') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Pertanyaan Bootcamp">
                <a href="{{ url('contributor/bootcamp/comments') }}">
                    <img src="{{asset('template/kontributor/img/icon/KelolaPertanyaan.png')}}" alt="" />
                    <span>Pertanyaan Bootcamp</span>
                </a>
            </li>
            <li class="{{ request()->is('contributor/account') ? 'icon-active' : '' || request()->is('contributor/account/*') ? 'icon-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Kelola Akun Dan Halaman">
                <a href="{{ url('contributor/account/informasi') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Akun_dan_Halaman.png')}}" alt="" />
                    <span>Kelola Akun dan Halaman</span>
                </a>
            </li>
        </ul>
    </div>

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <img class="footer-logo" src="{{asset('template/kontributor/img/logo-only.png')}}" alt=""></img>
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
    <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap-3.3.7.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/step-modal.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/dropify.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.dm-uploader.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.dm-uploader.ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/Ply.min.js')}}"></script>
    {{-- <script type="text/javascript" src="{{asset('template/kontributor/js/Sortable.min.js')}}"></script> --}}
    {{-- <script src="/js/app.js"></script> --}}

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      function contribnotif(id){
        var token   = "{{csrf_token()}}";
        var dataString= '_token='+ token + '&id=' + id ;
         $.ajax({
          type:"GET",
          url:"{{url('ajax/notif/view')}}",
          data:dataString,
          success:function(data){
          }
        });
      }
    </script>

</body>

</html>