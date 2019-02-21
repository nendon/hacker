<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(env('APP_ENV') == 'production')
    <meta name="google-site-verification" content="0r-wquIwdvygXwMpsK8-xcBaNyh36Fw-OUJWZoOKvZk" />
    @endif
    <!-- Hotjar Tracking Code for www.cilsy.id -->
    <script>
    (function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:1055058,hjsv:6};
    a=o.getElementsByTagName('head')[0];
    r=o.createElement('script');r.async=1;
    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
    a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <link href="{{asset('template/web/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('css/timelines-vertical.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/video-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/plyr.css')}}">
    <link href="{{asset('template/web/css/video-js.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/pace.css')}}" rel="stylesheet">
    <link href="{{ asset('template/web/css/venobox.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/flickity@2.1.2/dist/flickity.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- rating -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/>
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.9.0/slick/slick-theme.css"/> -->
    <link rel="stylesheet" href="{{ asset('template/web/css/star-rating.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/web/css/imageviewer.css') }}" />
    <!-- rating -->
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.theme.green.min.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{asset('template/kontributor/img/logo-only.png')}}"/>
    <link rel="stylesheet" href="{{ asset('template/web/plugins/ionicons-2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    
    <!-- Jquery UI   -->


    <link rel="stylesheet" href="{{ asset('template/web/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <script type="text/javascript" src="{{asset('template/web/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/web/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/web/js/venobox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/web/js/imageviewer.min.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert2@7.9.2/dist/sweetalert2.all.js"></script>
    <!-- Jquery UI   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.2/plupload.full.min.js"></script>
    {{--  <script type="text/javascript" src="{{ asset('template/web/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>  --}}
    <script type="text/javascript" src="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/owl.carousel.js') }}"></script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '121629818418908'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=121629818418908&ev=PageView&noscript=1"
    /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
    <!-- start Mixpanel -->
    <script type="text/javascript">
    // (function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
    // 0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
    // for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
    // mixpanel.init("b208ef84bd5045e39433ef24aa0b823c");
    </script>
    <!-- end Mixpanel -->
    <style media="screen">
    .owl-prev {
    width: 15px;
    height: 100px;
    position: absolute;
    top: 40%;
    margin-left: -20px;
    display: block!IMPORTANT;
    border:0px solid black;
    }
    .owl-next {
        width: 15px;
        height: 100px;
        position: absolute;
        top: 40%;
        right: -25px;
        display: block!IMPORTANT;
        border:0px solid black;
    }
    .owl-prev i, .owl-next i {transform : scale(1,6); color: #333;}
    .loading{
        position: fixed;
        background: #2BA8E2;
        left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
        z-index: 9999999;
    }
    .middle{
        display: table;
        width: 100%;
        height: 100vh;
        text-align: center;
    }
    .middle-item{
        display: table-cell;
        vertical-align: middle;
        /*width: 100%;
        height: 100vh;*/
    }
      .drop-down{
        position: relative;
        display: inline-block;
      }
      .drop-down-content{
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        /* min-width: 160px; */
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-left: -270px;I have jQuery code, which looks this way:
        right: 0px;
        padding: 15px;
      }
      .drop-down:hover .drop-down-content,.drop-down:focus .drop-down-content ,.drop-down:active .drop-down-content {
        display: block;
      }
      .btn-package{
        margin-right: 5px
      }
      /*.btn-signout{
        margin-right: 5px
      }*/
      @media (min-width: 768px){
        .navbar-form {
          width: 29%;
      }
      }
      @media (min-width: 768px){
        .navbar-nav>li {
            padding-top: 9px;
            padding-bottom: 9px;
            margin-top: 7px;
        }
      }
      .navbar-form {
          margin-top: 13px;
          background: #eee;
          padding: 5px;
          margin-left: 25px;
          margin-right: 0px;
      }
      @media (max-width:768px) {
        .navbar-form {
            margin-top: 13px;
            background: #eee;
            padding: 5px;
            margin-left: 0px;
            margin-right: 0px;
        }
      }
      @media (min-width:768px) {
        #bs-example-navbar-collapse-search{
          display: none !important;
          animation: slideInLeft 1s;
          left: 0px;
        }
      }
      #bs-example-navbar-collapse-search p{
        border-bottom: 1px solid #fff;
        padding-bottom: 5px;
        color: #fff;
      }
      #bs-example-navbar-collapse-search .dropdown-menu{
        position: relative;
      }
      .navbar-toggle.navbar-left {
  float: left;
  margin-left: 10px;
}
.navbar-toggle{
  float:left
}
@media (max-width: 990px) {
  .navbar-header {
      float: none;
  }
  .navbar-toggle {
      display: block;
  }
  .navbar-collapse {
      border-top: 1px solid transparent;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
  }
  .navbar-collapse.collapse {
      display: none!important;
  }
  .navbar-nav {
      float: none!important;
      margin: 7.5px -15px;
  }
  .navbar-nav>li {
      float: none;
  }
  .navbar-nav>li>a {
      padding-top: 10px;
      padding-bottom: 10px;
  }
}
.search-toogle {
    font-size: 20px;
    color: #fff;
    padding-top: 4px;
    float:right;
    padding-bottom: 0px;
}
@media (max-width:768px) {
  .navbar-default .logo{
    height: 40px;
    position: absolute;
    left: 0;
    right: 0;
    display: block;
    margin: 0 auto;
    margin-top: -10px;
  }
}
.navbar-brand {
    float: left;
    height: 50px;
    padding: 15px;
    padding-left: 0px;
    font-size: 18px;
    line-height: 20px;
    text-align: center;

}
      .global-notification {
    background: #FFEB3B;
    color: #fffff;
    text-align: center;
}
.navbar-form .btn-category .btn {
    padding: 10px 12px;
    background: #fff;
    width: 59%;
}
.navbar-form .form-control {
    height: 43px;
    padding-left: 25%;
}
.input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group {
    margin-right: 70px;
}
  #btn {
  position: fixed;
  z-index: 5;
  top: 15px;
  left: 15px;
  cursor: pointer;
  transition: left 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}
#btn div {
  width: 35px;
  height: 2px;
  margin-bottom: 8px;
  background-color: #fff;
  transition: opacity 500ms, background-color 250ms, -webkit-transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
  transition: transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, background-color 250ms;
  transition: transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, background-color 250ms, -webkit-transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}

#btn.active {
  left: 310px;
}
#btn.active div {
  background-color: #fff;
}
#btn.active #top {
  -webkit-transform: translateY(10px) rotate(-135deg);
          transform: translateY(10px) rotate(-135deg);
}
#btn.active #middle {
  opacity: 0;
  -webkit-transform: rotate(135deg);
          transform: rotate(135deg);
}
#btn.active #bottom {
  -webkit-transform: translateY(-10px) rotate(-45deg);
          transform: translateY(-10px) rotate(-45deg);
}

#box {
  position: fixed;
  z-index: 4;
  overflow: auto;
  top: -57px;
  left: -275px;
  width: 300px;
  opacity: 0;
  padding: 20px 0px;
  bottom:  0px;
  background-color: #f6f6f6;
  color: #343838;
  transition: all 350ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}

#box.active {
  left: 0px;
  opacity: 1;
}

#items {
  position: relative;
  top: 25%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

#items .item {
  position: relative;
  cursor: pointer;
  font-size: 18px;
  padding: 20px 20px;
  transition: all 250ms;
}
a #items .item {
  color: #343838;
  text-decoration: none;
}
#items .item:hover {
  padding: 15px 45px;
  background-color: rgba(52, 56, 56, 0.2);
}

#btn, #btn * {
  will-change: transform;
}

#box {
  will-change: transform, opacity;
}
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
.badge-cart-mobile {
  background-color: red;
  border-radius: 10px;
  color: white;
  display: inline-block;
  font-size: 10px;
  line-height: 1;
  padding: 2px 5px;
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  margin-left: 20px;
  margin-top: -55px;
}


.shopping-cart {
  margin: 75px 710px;
  float: right;
  background: white;
  width: 320px;
  position: absolute;
  border-radius: 3px;
  padding: 20px;
}
.shopping-cart .shopping-cart-header {
  border-bottom: 1px solid #E8E8E8;
  padding-bottom: 15px;
}
.shopping-cart .shopping-cart-header .shopping-cart-total {
  float: right;
}
.shopping-cart .shopping-cart-items {
  padding-top: 20px;
  list-style: none;
  margin-left: -45px;
}
.shopping-cart .shopping-cart-items li {
  margin-bottom: 18px;
}
.shopping-cart .shopping-cart-items img {
  float: left;
  margin-right: 12px;
}
.shopping-cart .shopping-cart-items .item-name {
  display: block;
  padding-top: 10px;
  font-size: 16px;
}
.shopping-cart .shopping-cart-items .item-price {
  color: #6394F8;
  margin-right: 8px;
}
.shopping-cart .shopping-cart-items .item-quantity {
  color: #ABB0BE;
}

.shopping-cart:after {
  bottom: 100%;
  left: 89%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-bottom-color: white;
  border-width: 8px;
  margin-left: -8px;
}

.cart-icon {
  color: #515783;
  font-size: 24px;
  margin-right: 7px;
  float: left;
}

.button {
  background: #6394F8;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  display: block;url
  border-radius: 3px;
  font-size: 16px;
  margin: 25px 0 15px 0;
}
.button:hover {
  background: #729ef9;
  text-decoration: none;
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
.dropdown-container{
    display: none;
    position: absolute;
    top: 53px;
    right: -8px;
    width: 250px;
    padding: 10px 0;
    border: 1px solid #DBDEDE;
    border-radius: 6px;
    background-color: #FFF;
    z-index: 99;
}
.ui-autocomplete {
  transition: opacity 1s;
  -moz-transition: opacity 1s;
  -webkit-transition: opacity 1s;
  -o-transition: opacity 1s;
}

.ui-autocomplete.opened {
  opacity: 1;
}

    </style>
    <!-- Landing page -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/bootcamp/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('template/bootcamp/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('template/bootcamp/css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('template/bootcamp/css/landingpage.css')}}">
    
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="{{ asset('template/web/css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/blocks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timelines-vertical.css') }}">
     <!-- <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
 -->
    @stack('css')
</head>

<!-- <body oncontextmenu="return false;"> -->
<body>
    <!--<div class="loading">
        &nbsp;
        <div class="middle">
            <div class="middle-item">
                <img src="{{asset('template/web/img/logo.png')}}" alt="cilsy" class="logo">
            </div>
        </div>
    </div>-->
    <!-- Navbar -->

    <nav class="navbar navbar-default navbar-fixed-top">
    <?php if (empty(Session::get('memberID'))) {?>
    {{--  <div class="global-notification">
      <div class="container">
    <h4>
    <a href="{{ url('member/package') }}"><font color="red">Mau dapat Cashback Rp.50.000? Amankan Disini! Tersisa <font id="demo"></font> Hari lagi..</font></a>
    </h4>
    <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;' style="    position: absolute;
    right: 20px;
    top: 10px;">x</span>

    </div>  
    </div>  --}}
    <?php } ?>
      <div class="container">
        <div class="navbar-header navbar-fixed-side navbar-fixed-side-left">
            <div id="btn" class="hidden-lg hidden-md" onclick="sideBarOverlay()">
              <div id='top'></div>
              <div id='middle'></div>
              <div id='bottom'></div>
          </div>
          <div id="box">
            @if (Auth::guard("members")->user())
              <div id="items" style="top:38%">
                  <div class="item" style="background-color:white">Halo, {{ Auth::guard('members')->user()->username }}</div>
                  <a href="{{ url('lessons/browse/all') }}" class="hidden-lg hidden-md" style="color: #fff;"><div class="item browse" style="background-color:#2BA8E2;">Browse Tutorial</div></a>                  
                  <a href="{{ url('member/dashboard') }}" ><div class="item">Tutorial Saya</div></a>
                  <a href="{{ url('member/change-password') }}" ><div class="item">Ganti Password</div></a>
                  <a href="{{ url('member/riwayat') }}" ><div class="item">Riwayat Pembelian</div></a>
                  <a href="{{ url('member/signout') }}"><div class="item">Logout</div></a>
              </div>
              @else
                <div id="items">
                    <a href="{{ url('lessons/browse/all') }}" class="hidden-lg hidden-md" style="color: #fff;"><div class="item browse" style="background-color:#2BA8E2;">Browse Tutorial</div></a>
                    <a href="{{ url('member/signin') }}"><div class="item" onclick="w3_close()">Masuk</div></a>
                    <a href="{{ url('member/signup') }}"><div class="item">Daftar</div></a>
                </div>
              @endif
            </div>
            <div class="w3-overlay w3-animate-opacity"  style="cursor:pointer"  id="myOverlay"></div>

          <a href="{{ url('cart')}}" class="navbar-brand pull-right hidden-lg hidden-md" >
          <i style="height: 32px; width: 32px; color: white;" class="fa fa-shopping-cart">
              @if (Auth::guard("members")->user())
                <?php if(getTotalCart() != null){ ?>
                        <span class="badge-cart-mobile"><?php echo getTotalCart();?></span>
                        <?php } ?>
              @else
                <span class="badge-cart-mobile hide"> <?php echo getTotalCart();?></span>
              @endif
          </i>
          </a>
          <button type="button" class="navbar-toggle collapsed search-toogle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-search" aria-expanded="false">
            <!-- <span class="sr-only">Toggle navigation</span> -->
            <i class="ion ion-ios-search-strong"></i>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="{{asset('template/web/img/logo.png')}}"></a>
          <a href="{{ url('lessons/browse/all') }}" class="browse-btn hidden-xs hidden-sm">Browse Tutorial</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <!-- <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form> -->
          <form class="navbar-form navbar-left form-search hidden-xs" action="{{ url('search') }}" method="get">
            <input type="hidden" name="category" value="" class="searchcategory">
            
            <div class="input-group">

              <div class="input-group-btn btn-category">
                <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="cate_title">
                  <i class="fa fa-th" aria-hidden="true"></i>
                  </span> <i class="ion-android-arrow-dropdown"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" id="cate">
                <?php echo getCategory(); ?>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Semua Kategori')">Semua Kategori</a>
                </div>
              </div>
              <input type="text" class="form-control keyword" aria-label="Text input with dropdown button " placeholder="Search" name="q">
              <span class="input-group-btn btn-search">
                 <button class="btn btn-secondary" type="submit"><i class="ion-android-search"></i></button>
               </span>
            </div>
          </form>
          @if (Auth::guard("members")->user())
          <div class="header-menu">
                <ul>
                    <li>
                      <a href="{{ url('member/dashboard')}}" class="hello-user" style=".hello-user:hover{ text-decoration:none;}">
                        Tutorial Saya
                      </a>
                    </li>
                    <li class="class">
                        <a  href="#" id="cart"><img class="icon" src="{{asset('template/web/img/CART.png')}}" alt="cart">
                        <?php if(getTotalCart() != null){ ?>
                        <span class="badge-cart"><?php echo getTotalCart();?></span>
                        <?php } ?>
                        </a>                   
                    </li>
                      
                    
                    <li class="has-dropdown">
                        <img class="icon" src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="">
                        <?php if(totalnotifuser() != null){ ?>
                        <span class="badge-cart"><?php echo totalnotifuser();?></span>
                        <?php } ?>
                        <div class="dropdown-container">
                            <ul>
                              <?php echo notifuser();?>
                              <li role="separator" class="divider"></li>
                              <li><a href="{{ url('/user/notif')}}">Lihat Semua Pemberitahuan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="has-dropdown">
                        <img class="icon" src="{{asset('template/web/img/drop-down-round-button.png')}}" alt="">
                        <div class="dropdown-container" style="right: 0px;">
                            <ul>
                                <li>
                                  
                                    <a href="{{ url('member/profile/'.Helper::member('username'))}}">
                                      @if(Helper::member('avatar') != null)
                                      <img src="<?=Helper::member('avatar');?>" class="poto img-circle" alt="" style="">
                                      @else
                                      <img src="{{asset(profil())}}" class="poto img-circle" alt="" style="">
                                      @endif
                                      @if(Helper::member('full_name') != null)
                                      <?=Helper::member('full_name');?>
                                      @else
                                      <?=Helper::member('username');?>
                                      @endif
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{ url('member/profile/edit')}}">
                                        Pengaturan Akun
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('member/riwayat')}}">
                                        Riwayat Pembelian
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <a id="logout" href="{{ url('member/signout')}}" style="font-color:#2BA8E2;">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
          </div>
          <div class="shopping-cart" style="display: none;">
            <ul class="shopping-cart-items">
              <?php echo cart();?>
              <?php if (getTotalCart()>3){ ?>
              <li style="text-align:center; color:#2BA8E2;"><a href="{{ url('/cart')}}" > See all ( <?php echo getTotalCart();?> )</a></li>
              <?php } ?>
            </ul>
            
            <a href="{{ url('/cart') }}" class="button">Lihat Keranjang</a>
          </div>
          @else
          <div class="header-menu">
            <ul class="navbar-nav navbar-right">
                <li class="class">
                  <a href="{{ url('/cart') }}" ><img class="icon" src="{{asset('template/web/img/CART.png')}}"  alt="cart">
                    <span class="badge-cart hide"></span>
                  </a>                   
                </li>
                <li><a href="{{ url('member/signin') }}">Masuk</a></li>
                <li><a href="{{ url('member/signup') }}">Daftar</a></li>
            </ul>
           </div>
          @endif
        </div><!-- /.navbar-collapse -->
            
        <div class="collapse navbar-collapse hidden-sm hidden-md hidden-lg" id="bs-example-navbar-collapse-search" style="overflow-y: visible;">
          <form class="navbar-form navbar-left form-search " action="{{ url('search') }}" method="get">
            <input type="hidden" name="category" value="" class="searchcategory">

            <div class="input-group">

              <div class="input-group-btn btn-category">
                <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  <span class="cate_title">
                    <i class="fa fa-th" aria-hidden="true"></i>
                  </span> <i class="ion-android-arrow-dropdown"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" >
                  <?php echo getCategory(); ?>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Semua Kategori')">Semua Kategori</a>
                </div>
              </div>
              <input type="text" class="form-control keyword" aria-label="Text input with dropdown button " placeholder="Search" name="q">
              <span class="input-group-btn btn-search">
                 <button class="btn btn-secondary" type="submit"><i class="ion-android-search"></i></button>
               </span>
            </div>
          </form>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
    <!--/. End Navbar -->

    <div id="header" class="hidden">
        <div class="container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{asset('template/web/img/logo.png')}}"></img>
            </a>
            <!-- <a href="{{ url('lessons/browse/all') }}" class="browse-btn">Browse Tutorial</a> -->
            <?php //Helper::searchForm(); ?>
            <div class="header-left pull-right">
              <?php if (!empty(Session::get('memberID'))) {?>
                <a href="#" class="masuk-btn">Halo, <?=Helper::member('username');?></a>
                <div class="drop-down">
                  <a href="#" style="color:#FFF" class="user-arrow">&#x25BE;</a>
                  <div class="drop-down-content">
                    <table cellpadding="15">
                      <tr>
                        <td><a href="{{ url('member/profile') }}" class="btn btn-success">Profil</a></td>
                        <td><a href="{{ url('member/signout') }}" class="btn btn-primary btn-signout">Logout</a></td>
                      </tr>
                    </table>
                  </div>
                </div>

              <?php } else {?>
                <a href="{{ url('member/signin') }}" class="masuk-btn">Masuk</a>
                <a href="{{ url('member/signup')}}" class="daftar-header-btn">Daftar</a>
              <?php }?>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
      @yield('content')
    </div>
        <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="footer-logo" src="{{asset('template/web/img/logo-only.png') }}" alt=""></img>
                    <span class="footer-logo-text">Cilsy</span>
                    <p>
                        Satu-satunya kursus online jaringan dan server yang dipandu sampai bisa. Terdapat ratusan video tutorial eksklusif serta trainer profesional yang siap membantu proses belajar anda.
                    </p>
                    <p class="copyrigth-text">
                        Copyright Cilsy Fiolution 2016-2018
                    </p>
                </div>
                <div class="col-md-2">

                  <?=Helper::pageMenu();?>

                </div>
                <div class="col-md-2">
                    <ul class="nav-footer">
                        <li>Ikuti Kami</li>
                        <li><a href="https://www.facebook.com/cilsyfiolution/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/cilsyfiolution/">Instagram</a></li>
                        <li><a href="#">Line</a></li>
                        <li><a href="#">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="nav-footer">
                        <li>Bantuan</li>
                        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                        <li><a href="{{ url('/kebijakan') }}">Kebijakan Layanan</a></li>
                        <li><a href="{{ url('/carapesan') }}">Cara Pesan</a></li>
                        <li><a href="{{ url('/petunjuk') }}">Petunjuk Pembayaran</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('https://linuxsupports.com') }}">Official Company</a></li>
                        <li><a href="{{ url('https://blog.cilsy.id') }}">Blog</a></li>
                        <li><a href="{{ url('https://devops.cilsy.id') }}">Sekolah DevOps Cilsy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="copyrigth-text">
                        Jl. Dr. Djundjunan No 169 RT 002 RW 002 Kel Husein Sastranegara Kec Cicendo Bandung
                    </p>
                </div>
            </div>
        </div>
    </div>
  <script>
  function sideBarOverlay() {
    var overlay = document.getElementById("myOverlay");
    if (overlay.style.display === "block") {
      overlay.style.display = "none";
    } else {
      overlay.style.display = "block";
    }
      
  }
  $("#logout").click(function(){
    localStorage.clear();
  });
</script>    
<script>
  var sidebarBox = document.querySelector('#box'),
      sidebarBtn = document.querySelector('#btn'),
      pageWrapper = document.querySelector('#page-wrapper');

      sidebarBtn.addEventListener('click', function (event) {
      sidebarBtn.classList.toggle('active');
      sidebarBox.classList.toggle('active');
      });

      pageWrapper.addEventListener('click', function (event) {

        if (sidebarBox.classList.contains('active')) {
            sidebarBtn.classList.remove('active');
            sidebarBox.classList.remove('active');
        }
      });

      window.addEventListener('keydown', function (event) {

        if (sidebarBox.classList.contains('active') && event.keyCode === 27) {
            sidebarBtn.classList.remove('active');
            sidebarBox.classList.remove('active');
            } 
      });
  </script>
 <script type="text/javascript">
    // $("#close").ready(function(){
    //   $("#top-section").css("margin-top", "76px")
    // })
    $(document).ready(function() {
      var btncategory = $('.btn-category').width();
      $('.dropdown-item').css('width',btncategory);
    });
    </script>
    <script type="text/javascript">
      function changeCategory(category, id) {
        $('.cate_title').text(category);
        if (category != 'Semua Kategori') {
          $('.searchcategory').val(id);
        }else {
            $('.searchcategory').val('');
        }
      }
      $(document).ready(function() {
    $('.dropdown-item').change(function() {

            // var url = '{{ url('category') }}' + '/' + $(this).val();
            const url = "search/autocomplete";
            const full = url + ($(".keyword").val() != "" ? ("q=" + $(".keyword").val()) : "" ) + ($('.dropdown-item').val() != "" ? ("&category=" + $('.dropdown-item').val()) : "");

            $.get(full, function(data) {
                var select = $('form input[name=lesson]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.nama + '</option>');
                });
            });
        });
    });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
    <script type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

    <script>
      $(document).ready(function() {
  $('.menu-icon').click(function(event){
    $('#sidebar').toggleClass('sidebar-expand');
    console.log('clicked');
  });
  $('#sidebar ul li').click(function(event) {
    $('#sidebar ul li').removeClass('icon-active')
    $(this).addClass('icon-active')
  });
  $('.header-menu .has-dropdown').on('click', function(event) {
    var _this = $(this).children('.dropdown-container');
    if (_this.css('display').toLowerCase() !== 'block') {
      $('.header-menu .dropdown-container').hide()
      _this.show()
    } else {
      _this.hide()
    }
  });
  $(document).click(function(){
    $('.dropdown-container').hide();
    $('#sidebar').removeClass('sidebar-expand');
  });
  $('.header-menu .has-dropdown, #sidebar').click(function(e){
    e.stopPropagation();
  });
});
(function(){
 
  $("#cart").on("click", function() {
    $(".shopping-cart").fadeToggle( "fast");
  });
  
})();
    </script>
    <!-- Search Form Auto complete -->
    <script type="text/javascript">
        
    $(function() {
      let autocompleteData = {id: 1};

      $("#cate").change(function () {
        {{--  console.log($('.searchcategory').val());  --}}
        autocompleteData.id = this.value;
                  $(".keyword").autocomplete("search");
              });
      $(".keyword").autocomplete({
        source: function(request, response) {
          $.ajax({
              url: "{{ url('search/autocomplete')}}",
              type: "GET",
              dataType: "json",
              data: {id: $('.searchcategory').val()},
              success: function(data) {
                  response($.map(data, function(item) {
                    if ( item.value.toUpperCase().indexOf(request.term.toUpperCase()) != -1 ) {
                      return {
                        label: item.value,
                        value: item.value,
                        slug: item.slug
                    };
                    }
                    
                  }));
              }
          });
        },
        select:function(event,ui) {
          $(".keyword").val(ui.item.label);
          return false;
        },
        minLength: 2,
        select: function(event, ui) {
          window.location = "/lessons/" + ui.item.slug;
      }
      }).bind('focus', function () {
        console.log($('.searchcategory').val());  

        $('.ui-autocomplete').css('z-index','9999').css('overflow-y','scroll').css('max-height','300px');
       // $('.ui-autocomplete').css('background','#09121a').css('color','#fff');
        //$('.ui-menu .ui-menu-item-wrapper').css('padding','11px 1em 3px 1.4em !important');
        // $(this).autocomplete("search");
        // var btncategory = $('.btn-category').width();
        // var left = '-'+btncategory+'px';
      });
    });
    </script>
    {{--  <script>
      jQuery(document).ready(function($) {
          // Set the Options for "Bloodhound" suggestion engine
          var engine = new Bloodhound({
              remote: {
                  url: "{{ url('search/autocomplete')}}",
              },
              datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
              queryTokenizer: Bloodhound.tokenizers.whitespace
          });

          $(".keyword").typeahead({
              hint: true,
              highlight: true,
              minLength: 1
          }, {
              source: engine.ttAdapter(),

              // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
              name: 'usersList',

              // the key from the array we want to display (name,id,email,etc...)
              templates: {
                  empty: [
                      '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                  ],
                  header: [
                      '<div class="list-group search-results-dropdown">'
                  ],
                  suggestion: function (data) {
                      return '<a href="/lessons/' + data.slug + '" class="list-group-item">' + data.title + '</a>'
            }
              }
          });
      });
  </script>  --}}
    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/58c547d85b89e2149e155e47/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    {{--  <script>
// Set the date we're counting down to
    var countDownDate = new Date("Feb 10, 2018 23:59:59").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get todays date and time
        var now = new Date().getTime();
        
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days 
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script>  --}}

    <script type="text/javascript">
      function notifview(id){
        var token   = "{{csrf_token()}}";
        var dataString= '_token='+ token + '&id=' + id ;
         $.ajax({
          type:"GET",
          url:"{{url('user/notif/view')}}",
          data:dataString,
          success:function(data){
          }
        });
      }
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-101007788-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="{{asset('template/web/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/web/js/pace.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/timeline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plyr.min.js')}}"></script>

    <!-- rating -->
    <script src="{{ asset('template/web/js/star-rating.min.js') }}"></script>
    <!-- rating -->
    <!-- Custom Js -->
    <script>
      var TOKEN = '{{ csrf_token() }}';
      var MEMBER = {{ Auth::guard('members')->user()->id ?? 'null' }};
      var SITE_URL = '{{ url('/') }}';
    </script>
    <?php $mtime = file_exists(public_path('template/web/js/custom.js')) ? filemtime(public_path('template/web/js/custom.js')) : '' ?>
    <script type="text/javascript" src="{{ asset('template/web/js/custom.js?'.$mtime) }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @stack('js')
</body>

</html>
