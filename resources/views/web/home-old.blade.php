@extends('web.app')
@section('title','')
@section('content')
<div id="top-section" style="margin-top: 115px;">
        <p>
            Belajar dari 500++ tutorial Networking, Server, dan IoT Ekslusif<br>
            Online. Kapanpun, Dimanapun.<br>
        </p>

        <?php if (Session::get('memberID')): ?>
            <a href="{{ url('lessons/browse/all')}}" class="daftar-btn">Browse</a>

        <?php else: ?>

          <a href="{{ url('member/signup')}}" class="daftar-btn">Daftar</a>
        <?php endif;?>
    </div>

    <div id="content-section">
        <div id="cat-images">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div id="category_carousel" class="owl-carousel owl-theme">
                      <?php foreach ($categories as $key => $category): ?>
                        <div class="item cat-img-container">
                          <a href="{{ url('lessons/category/'.$category->title)}}">
                            <img src="{{ $category->image }}" />
                            <p>{{ $category->title }}</p>
                          </a>
                        </div>
                      <?php endforeach;?>
                      <div class="item cat-img-container">
                        <a href="{{ url('lessons/browse/all') }}">
                          <img src="https://www.cilsy.id/assets/source/category/tutorial.png" alt=""></img>
                          <p>Semua Tutorial</p>
                        </a>
                      </div>
                    </div>

                    <script type="text/javascript">
                      $('#category_carousel').owlCarousel({
                          loop:false,
                          margin:0,
                          nav:true,
                          navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                          // items:1,
                          responsive:{
                              0:{
                                  items:1
                              },
                              600:{
                                  items:3
                              },
                              1000:{
                                  items:4
                              }
                          }
                      });
                    </script>




                  </div>

                </div>
            </div>
        </div>
        <?php foreach ($categories as $key => $categori): ?>

        <div id="cat-section">
            <div class="container">
                <p class="title-cat">{{ $categori->title }} </p>
                <div class="row">
                    <?php
$i = 1;
foreach ($lessons as $key => $lesson): ?>
                        <?php if ($categori->id == $lesson->category_id) {?>
                            <?php if ($i <= 8) {?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <a href="{{ url('lessons/'.$lesson->slug)}}">
                                            <?php if (!empty($lesson->image)) {?>
                                              <div class="card-img" style="background-image: url('{{ asset($lesson->image)}}');"></div>
                                            <?php } else {?>
                                              <div class="card-img" style="background-image: url('{{ asset('template/web/img/no-image-available.png')}}');"></div>
                                            <?php }?>

                                            <div class="card-body">
                                                <p class="card-title">{{ $lesson->title }}</p>
                                            </div>

                                        </a>
                                    </div>
                                </div>
                                <?php }?>
                            <?php $i++;?>
                        <?php }?>

                    <?php endforeach;?>

                    <!-- <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy-2.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Training Linux Administrator Basic</p>
                                    <p class="card-info">Total 10 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Training Linux Fundamental Fedora 2</p>
                                    <p class="card-info">Total 12 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy-2.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Training Linux Ubuntu BlankOn Tambora</p>
                                    <p class="card-info">Total 10 Video</p>
                                </div>
                            </a>
                        </div>
                    </div> -->
                </div>
                <p><a href="{{ url('lessons/category/'.$categori->title)}}" class="selengkapnya-btn">Selengkapnya</a></p>
            </div>
        </div>

        <?php endforeach;?>
        <!-- <div id="cat-section">
            <div class="container">
                <p class="title-cat">MIKROTIK <a href="#" class="selengkapnya-btn">selengkapnya</a></p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy-2.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Training Mikrotik Warnet</p>
                                    <p class="card-info">Total 13 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Tutorial Mikrotik Hotspot</p>
                                    <p class="card-info">Total 10 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy-2.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Tutorial Mikrotik Hotspot</p>
                                    <p class="card-info">Total 12 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-img" style="background-image: url('img/dummy.jpg');"></div>
                                <div class="card-body">
                                    <p class="card-title">Training Mikrotik Warnet</p>
                                    <p class="card-info">Total 10 Video</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <a href="{{ url('lessons/browse/all')}}" class="lihat-semua-btn">
       Lihat Semua
    </a>

@endsection()
