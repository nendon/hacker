@extends('web.app')
@section('title','Browse Bootcamp')
{{--  <link rel="stylesheet" href="{{asset('css/slick.css')}}">  --}}
<style>
a.divlink { 
 width:25%px;
}        
</style>
@section('content')
<!-- Main -->
    <main>
      
      <!-- Container -->
      <div class="container-fluid">

        <!-- Header -->
        <div class="row headerBootcamp">
          <div class="col-sm-6 col-xs-12">
            <h1>Write Your Success Story in our Bootcamp programs</h1>
            <p>
              Kuasai berbagai skill IT yang relevan dengan kemajuan pesat
              industri masa kini. Belajar dan buat portofolio Anda
              semakin terpercaya untuk memulai karir impian
            </p>

          </div>
        </div>



        <div class="container mt-4">

          <div class="row">
            <div class="col-xs-12">
              <h2>Pilih Kategori Bootcamp</h2>

              <div class="kategori">
                @foreach($boot as $boots)
               <a href="{{url('browse/bootcamp/'.$boots->slug)}}" style="text-decoration:none; color:black;">
                <div>
                  <div class="kotak" style="background:url({{asset($boots->cover)}}); background-size:cover;">
                    <h4 style="font-weight: bold';">{{$boots->title}}</h4>
                  </div>
                </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>
          @foreach($boot as $key)
          <div class="row kategori-list ">
            <div class="col-xs-12">
              <h2>{{$key->title}}</h2>
              <a href="{{url('browse/bootcamp/'.$key->slug)}}" class="btn btn-blue pull-right mt-4">Selengkapnya</a>

              <p>
                    {!! nl2br($key->meta_desc) !!}
              </p>

              <div class="programming" width="0px">
                @foreach($key->bootcamp as $result)                
                <div>
                  <a href="{{url('bootcamp/'.$result->slug)}}" class="divlink" style="text-decoration:none; color:black;">
                  <div class="card">
                    <div class="label">
                      Bootcamp
                    </div>
                    <img src="{{asset($result->cover)}}" class="card-img-top img-responsive" alt="" style="background-size:cover;">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset($result->contributor->avatar)}}" class="img-author" alt="">
                        <small class="text-muted">{{ $result->contributor->username}}</small>
                      </div>
                      <h5>
                        {{$result->title}}
                      </h5>
                      <p>
                        {!! $result->sub_title !!}
                      </p>
                      <ul>
                        <li>
                          <i class="fa fa-book"></i> {{count($result->course)}} Course
                        </li>
                        <li>
                          <i class="fa fa-user"></i> {{count($result->bootcamp_member)}} Siswa
                        </li>
                        <li>
                          <a href="{{url('bootcamp/'.$result->slug)}}"> Selengkapnya</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                 </a>
                </div>
                @endforeach()
              </div>
            </div>
          </div>
          @endforeach()
           
          <div class="row video sm-flex">
            <!-- Menukar class p-0 dan content agar perbandingan luasnya bertukar -->
            <div class="col-sm-5 col-xs-12 p-0">
              <!-- <img src="asset/1.jpg" class="img-responsive" alt=""> -->
              <iframe width="100%" height="77%" src="https://www.youtube.com/embed/yhIQSvNlri4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </video>
            </div>
            <div class="col-sm-7 col-xs-12 content" >
              <h2>Apa itu Program Bootcamp?</h2>
              <p>
              Program Kelas Bootcamp Online intensif untuk mendidik Anda menjadi seorang IT Talent Professional dalam 3 bulan dengan kesempatan pernyaluran magang dan kerja.
              </p>
            </div>
          </div>

          <div class="row features">
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="{{asset('img/asset/CompleteCurriculum.svg')}}" alt="">
              <h4>Complete Curriculum</h4>
              <p class="px-5">
              Kurikulum dirancang agar Anda yang tidak memiliki background IT tetap bisa memulai karir di dunia IT. Lengap, berurutan, dan sesuai dengan kurikulum industri.
              </p>
            </div>
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="{{asset('img/asset/RealProjectGetReview.svg')}}" alt="">
              <h4>Real Project, Get Review</h4>
              <p class="px-5">
              Selama pembelajaran, Anda akan mengerjakan berbagai exercise dan real project. Memastikan Anda benar-benar paham dengan materi dan implementasinya di industri.
              </p>
            </div>
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="{{asset('img/asset/ReadytoGetHired.svg')}}" alt="">
              <h4>Ready to Get Hired</h4>
              <p class="px-5">
              Lulusan Bootcamp Cilsy akan diberikan kesempatan magang selama 2-3 bulan untuk lebih mengasah skill dan pengalaman dan pada akhirnya siap untuk ditempatkan berkarir di berbagai perusahaan partner Cilsy. 
              </p>
            </div>
          </div>
          
        </div>
      
        <div class="m-5">x</div>
      </div>

    </main>
    <script type="text/javascript" src="{{asset('js/slick.min.js')}}"></script>
    <script>
    $('.kategori').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

    var settingslick = {
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    };

    $('.programming').slick(settingslick);

    $('.data-science').slick(settingslick);

    $('.it-ops').slick(settingslick);
    </script>
@endsection()