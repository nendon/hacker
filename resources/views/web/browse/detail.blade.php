 @extends('web.app')
@section('title', $bucat->title.' Bootcamp')
<!-- <link rel="stylesheet" href="{{asset('css/halaman.css')}}">
{{--  <link rel="stylesheet" href="{{asset('css/slick.css')}}">  --}}
<link rel="stylesheet" href="{{asset('css/slick-theme.css')}}"> -->

@push('css')
<style type="text/css">
a.divlink { 
 width:100%;
}        
</style>

<style>
.pointer {
  cursor: pointer;
}
</style>
@endpush


@section('content')
    <main>
      
      <!-- Container -->
      <div class="container-fluid">

        <!-- Header -->
        <div class="row header">
          <div class="col-xs-12">
            <h1>{{$bucat->title}}</h1>
            <p>
              {!! nl2br($bucat->meta_desc) !!}
            </p>
              
            <div class="kategori-small">
            @foreach($cat as $keys)
            <a href="{{url('browse/bootcamp/'.$keys->slug)}}" style="text-decoration:none;">
              <div>
                <h5>{{$keys->title}}</h5>
              </div>
            </a>
            @endforeach()
            </div>
          </div>
        </div>



        <div class="container mt-4">
          <div class="row">

            <div class="col-xs-12 mt-5">
              <h3 class="my-5">Bootcamp {{$bucat->title}} Terbaru</h3>
              
              <div class="slick2 mt-5">
                @foreach($new as $news)
                <div onclick="location.href='{{url('bootcamp/'.$news->slug)}}'" class="pointer">
                  <!-- <a href="{{url('bootcamp/'.$news->slug)}}" > -->
                  <div class="row box sm-flex p-0 mx-0">
                    <div class="col-sm-4 col-xs-12 p-0 preview" style="background: url({{asset($news->cover)}});background-size:cover;">
                      <div class="label">
                        Bootcamp
                      </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                      <ul class="breadcrumb">
                        <li><a href="{{url('browse/bootcamp/'.$news->bootcamp_category->slug)}}">{{$news->bootcamp_category->title}}</a></li>
                        <li class="active">{{$news->title}}</li>
                      </ul>

                      <div class="author">
                        <img src="{{$news->contributor->avatar}}" class="img-author" alt="">
                        {{$news->contributor->first_name}} {{$news->contributor->last_name}}
                      </div>

                      <h4>{{$news->title}}</h4>
                      <p>
                        {{$news->sub_title}}
                      </p>

                      <div class="my-4">
                          <ul class="icon">
                            <li>
                              <i class="fa fa-book-open"></i> {{count($news->course)}} Course
                            </li>
                            <li>
                              <i class="fa fa-users"></i> {{count($news->bootcamp_member)}} Siswa
                            </li>
                          </ul>
                        <div class="pull-right">
                          <a href="{{url('bootcamp/'.$news->slug)}}" class="btn btn-blue mb-4">Selengkapnya</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- </a> -->
                </div>
                @endforeach()
              </div>
            </div>

          </div>

            <div class="row kategori-list">
              <div class="col-xs-12">
                <h3>Semua Bootcamp {{$bucat->title}}</h3>
              </div>
            
              <!-- Box Content -->
              @foreach($hasil as $has)
              
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-4" style="height:100%;">
                <a href="{{url('bootcamp/'.$has->slug)}}" style="text-decoration:none; color:black;">
                  <div class="card"  >
                    <div class="label">
                      Bootcamp
                    </div>
                    <img src="{{asset($has->cover)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset($has->contributor->avatar)}}" class="img-author" alt="">
                        <small class="text-muted">{{$has->contributor->first_name}} {{$has->contributor->last_name}}</small>
                      </div>
                      <h5>
                        {{$has->title}}
                      </h5>
                      <p>
                        {{$has->sub_title}}
                      </p>
                      <ul>
                        <li>
                          <i class="fa fa-book"></i> {{count($has->course)}} Course
                        </li>
                        <li>
                          <i class="fa fa-user"></i> {{count($has->bootcamp_member)}} Siswa
                        </li>
                        <li>
                          <a href="{{url('bootcamp/'.$has->slug)}}"> Selengkapnya</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach()
              <!-- End Box Conten -->
           </div>
            <!-- menampbahkan pagination -->
            <div class="row mt-5">
              <div class="col-xs-12 text-center">
                <div class="col-md-12 text-center">
                  {{ $hasil->links() }}
                </div>
              </div>
            </div>
          
          </div>
        </div>
        <div class="m-5"> </div>
      </div>

    </main>
    <script type="text/javascript" src="{{asset('js/slick.min.js')}}"></script>
    <script>
            $('.kategori-small').slick({
              dots: true,
              infinite: false,
              speed: 300,
              slidesToShow: 4,
              slidesToScroll: 4,
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
        
            $('.slick2').slick({
              dots: true,
              infinite: false,
              speed: 300,
              slidesToShow: 1,
              slidesToScroll: 1,
            });
    </script>
@endsection()