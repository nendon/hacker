@extends('web.app')
@section('title',$bca->title)
@section('description', $bca->description)
@section('content')
  <!-- <section class="header">

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
  </section> -->
  
      
      <!-- Container -->
      <div class="container w-100">

        <!-- Header -->
        <div class="row header">
          <div class="col-xs-12">
            <ul class="breadcrumb">
              <li><a href="#">Browse</a></li>
              <li><a href="#">Data Science</a></li>
              <li class="active">Data Analysis</li>
            </ul>
          </div>
          <div class="col-md-5 col-xs-12 mb-4 video-previews">
            <img src="{{asset($bca->cover)}}" class="img-responsive img-rounded" alt="">
            <a href="#" data-toggle="modal" data-target="#ModalVideo" class="btn"><img src="{{ asset('/template/web/img/play-button.svg') }}" class="img-play-size" alt=""></a>
          </div>
          <div class="col-md-7 col-xs-12 mb-4">
            <span>Bootcamp</span>

            <h2>Bootcamp {{$bca->title}}</h2>
            <h4>
              {{$bca->deskripsi}}
            </h4> 
            <h6 class="mb-5">oleh {{$contributors->username}}</h6>
            <button class="btn btn-blue m-2">Daftar Sekarang</button>
            <button class="btn btn-blue m-2">Download Silabus</button>
          </div>
        </div>

        <!-- Tahukan Anda -->
        
        <div class="row section1">
          <div class="container">
            <div class="col-md-5 col-sm-8 col-xs-12 px-0">
              <img src="{{asset('template/bootcamp/asset/2.jpg')}}" class="img-responsive" alt="">
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12 px-5">
              <h3>Tahukan Anda?</h3>
              <p>
              Ketika server yang Anda kelola down akan butuh waktu cukup lama untuk
              mengembalikannya online. Dan ternyata kalau Anda mau menambah layanan / aplikasi
              baru, ya harus install PC Server baru. Boros waktu, apalagi biaya membengkak. Banyak
              sekali server yang tumbang karena ulah hacker yang berusaha menerobos masuk.
              Mungkin Anda sudah tau ahwa solusinya adalah dengan virtualisasi, tapi tidak paham
              cara implementasinya. Apakah Anda salah satunya ??
              </p>

              <br>
              <h5>Anda Merasakan Ini?</h5>
              <p>
              Anda sebagai pemula bingung mulai dari mana belajar seluk belu virtualisasi server
              karena tutorial di internet bertebaran secara acak ?
              </p>

              <p>  
              Server ditempat Anda sering bermasalah, bahkan down karena banyaknya hujan
              serangan dari luar, sehinggan user komplain ?
              </p>

              <p>  
              Bingung bagaimana membuat server yang tangguh + memiliki keamanan baik + hemat
              biaya pembuatan ?
              </p>
            </div>
          </div>
      </div>

      <div class="row section2">
        <div class="container">
          <div class="col-md-5 col-sm-8 col-xs-12 px-0 col-md-push-7 pull-md-right">
            <img src="{{asset('template/bootcamp/asset/3.jpg')}}" class="img-responsive" alt="">
          </div>

          <div class="col-md-7 col-sm-12 col-xs-12 px-5 col-md-pull-5">
            <h3>Tentang Bootcamp {{$bca->title}}</h3>

            <ul id="about">
                <li class="panel">
                    <a href="#about1" data-toggle="collapse" data-parent="#about" class="collapsed">
                      Deskripsi
                    </a>
                    <p id="about1" class="collapse in">
                      {{$bca->deskripsi}}
                    </p>
                </li>
                <li class="panel">
                    <a href="#about2" data-toggle="collapse" data-parent="#about">
                      Kenapa harus belajar {{$bca->title}}?
                    </a>
                    <p id="about2" class="collapse">
                        Program akan membantu Anda, menguasai keterampilan dan tools seperti
                        Statistik, pengujian Hipotesis, Clustering, Decision tree, Linear dan Regresi
                        logistik, R Studio, Visualisasi Data, model Regresi, Hadoop, Spark, PROC SQL,
                        SAS Macro, prosedur statistik, tools dan analisis, dan masih banyak lagi.
                        Keterampilan ini akan membantu Anda mempersiapkan diri untuk seorang
                        Data Scientist.
                    </p>
                </li>
            </ul>
            </div>
          </div>

        </div>

      <div class="row section3">
        <div class="container">
          <div class="col-md-5 col-sm-8 col-xs-12 px-0">
            <img src="{{asset('template/bootcamp/asset/2.jpg')}}" class="img-responsive" alt="">
          </div>
          <div class="col-md-7 col-sm-12 col-xs-12 px-5">
            <h3 class="mb-5">Bagaimana Bootcamp membantu anda</h3>
            <h4>Daftar dan Pelajari</h4>
            <p>
              Bootcamp Cilsy adalah series course yang membatu anda menguasai keterampil
              Industri IT saat ini. CAri bootcamp yang ideal dengan kevek skll, kesukaan dan juga
              tujuan karir anda dimasa depan. Untuk memulainya, anda bisa membeli lalu
              mempelajarinya langsung. Kurikulum di bootcamp telat di sesuaikan dengan kebutuhan 
              industri dibuat oleh Instruktur superstar yang menguasai bidangnya.
            </p>

            <br>
            <h4>Kerjakan Real Projek, Dapatkan Review</h4>
            <p>
              Disetiap bootcamp anda harus menyelesaikan real projek untuk menunjukan anda telah
              berhasil dalam belajar. Projek yang dikerjakan, akan berguna untuk membuat portofolio
              saat melamar pekerjaan.
            </p>

            <br>
            <h4>Akselarasi karir Anda</h4>
            <p>
              Setelah berhasil dan menguasai skill yang dipelajarai, anda memiliki peluang untuk
              meningkatkan karir anda, bahkan anda siap untuk mendapatkan pekerjaan impian anda
            </p>
          </div>
        </div>
       </div>

        <div class="row silabus">
          <div class="container">
          <div class="col-xs-12 text-center">
              <h3>Silabus - Apa yang akan Anda Pelajari di Bootcamp ini</h3>

              <p class="text-muted">Kami membuat Program untuk menjadikan Anda seorang {{$bca->title}} dengan bantuan kurikulum yang terstruktur</p>
              <ul>
                <li><img src="{{asset('template/bootcamp/asset/smallicon-Estimasi.svg')}}" alt="">Estimasi 1-2 Bulan</li>
                <li><img src="{{asset('template/bootcamp/asset/smallicon-Projek.svg')}}" alt="">5 Projek</li>
                <li><img src="{{asset('template/bootcamp/asset/smallicon-Course.svg')}}" alt="">{{count($main_course)}} Course</li>
                <li><img src="{{asset('template/bootcamp/asset/smallicon-Waktu.svg')}}" alt="">120 Jam Video</li>
              </ul>
              <button class="btn btn-blue">Download Silabus</button>

          </div>

          <div class="col-xs-12 mt-5">
            <ul class="timelinez p-0">
              <?php
               $i = 1;
               $count = 0;
               foreach ($course as $key => $courses):
                if ($count==3) break;?>
              <li>
                <div class="timelinez-number">
                  <h4>Course</h4>
                  <h1><?php echo $i;?></h1>
                </div>
                <div class="timelinez-content">
                  <div class="row box p-0">
                    <div class="col-sm-4 col-xs-12 p-0 images" style="background: url({{asset($courses->cover_course)}});">
                      <!-- for image content use style background for full size of column -->
                    </div>
                    <div class="col-sm-8 col-xs-12">
                      <h4>{{$courses->title}}</h4>
                      <p>
                       {{$courses->deskripsi}}
                      </p>

                      <hr>
                      <img src="{{asset('template/bootcamp/asset/smallicon-Course.svg')}}" alt="">{{ count($courses->section) }} Lesson      
                      <a class="pull-right" data-toggle="collapse" href="#section{{$courses->id}}">+ Lebih banyak</a>
                    </div>
                    <div class="col-xs-12">
                        <div class="collapse" id="section{{$courses->id}}">
                          <ul class="lesson-detail">
                          <?php
                          $no = 1;
                              foreach ($courses->section as $key => $sections): ?>
                              <li>
                                <div class="lesson-number">Lesson <h3 class="m-0"><?php echo $no; ?></h3></div>
                                <div class="lesson-content">
                                <h4>{{$sections->title}}</h4>
                                <p class="mb-5">
                                  {{$sections->deskripsi}}
                                </p>
                                <img src="{{asset('template/bootcamp/asset/Lesson.svg')}}" alt=""> {{ count($main_videos) }} Video (Total 90min), 1Projek
                                </div>
                                <?php 
                                  $no++;
                                  endforeach; 
                                ?>
                              </li>

                          </ul>
                        </div>
                    </div>
                  </div>
                </div>
                <?php $i++;?>
                <?php $count++; ?>
                <?php endforeach; ?>
              </li>

              <div class="collapse" id="content-silabus">
                <ul class="timelinez p-0">
                  <?php $count = 0;
                  $a = 1;
                    foreach ($course as $key => $courses):
                    if($count>2 && $a>2 ){ ?>
                  <li>
                    <div class="timelinez-number">
                      <h4>Course</h4>
                      <h1><?php echo $a; ?></h1>
                    </div>
                    <div class="timelinez-content">
                      <div class="row box p-0">
                        <div class="col-sm-4 col-xs-12 p-0 images" style="background: url({{asset($courses->cover_course)}});">
                          <!-- for image content use style background for full size of column -->
                        </div>
                        <div class="col-sm-8 col-xs-12">
                          <h4>{{$courses->title}}</h4>
                          <p>
                            {{$courses->deskripsi}}
                          </p>
                          
                          <hr>
                          <img src="{{asset('template/bootcamp/asset/smallicon-Course.svg')}}" alt="">{{ count($courses->section) }} Lesson   
                          <a class="pull-right" data-toggle="collapse" href="#silabus{{$courses->id}}">+ Lebih banyak</a>
                        </div>

                        <div class="col-xs-12">
                        <div class="collapse" id="silabus{{$courses->id}}">
                          <ul class="lesson-detail">
                          <?php
                          $no = 1;
                              foreach ($courses->section as $key => $sections): ?>
                              <li>
                                <div class="lesson-number">Lesson <h3 class="m-0"><?php echo $no; ?></h3></div>
                                <div class="lesson-content">
                                <h4>{{$sections->title}}</h4>
                                <p class="mb-5">
                                  {{$sections->deskripsi}}
                                </p>
                                <img src="{{asset('template/bootcamp/asset/Lesson.svg')}}" alt="">12 Video (Total 90min), 1Projek
                                </div>
                                <?php 
                                  $no++;
                                  endforeach; 
                                ?>
                              </li>

                          </ul>
                        </div>
                    </div>
                      </div>
                    </div>
                    <?php 
                     }
                      
                      $a++;
                      $count++; 
                      endforeach ;?>
                  </li>
                </ul>
              </div>
            </ul>
                
            <div class="text-center">
              <a class="btn btn-blue" role="button" id="collapse1" data-toggle="collapse" href="#content-silabus">Tampilkan Lebih Banyak</a>
            </div>
          </div>
        </div>
        </div>

        <div class="row instruktur">
          <div class="col-xs-12 text-center">
            <h2 class="title text-muted">Belajar dari Instruktur superstar</h2>
          
            <div class="border-blue">
              <img src="{{asset('template/bootcamp/img/users.png')}}" class="img-responsive mx-auto" alt="">
              <h4 class="c-blue">Rizal Rahman</h4>
              <h5>Network Administrator</h5>
              <p class="text-muted">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
        </div>

        <div class="row testimoni">
          <div class="col-xs-12 text-center">
            <h2 class="title text-center">Testimoni dari Siswa</h2>
          </div>

          <div class="col-xs-12">

            <div class="slick mx-auto"  style="max-width: 800px;">
              <div>
                <div class="box">
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </p>
                  
                  <div class="name">
                    <img src="{{asset('template/bootcamp/img/users.png')}}" class="w-25 pull-left mr-4" alt="">
                    Rizki Alif irfany <br>
                    Google Expert
                  </div>
                </div>
              </div>

              <div>
                <div class="box">
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                  </p>
                  
                  <div class="name">
                    <img src="{{asset('template/bootcamp/img/users.png')}}" class="w-25 pull-left mr-4" alt="">
                    Rizki Alif irfany <br>
                    Google Expert
                  </div>
                </div>
              </div>

              <div>
                <div class="box image" style="background-image: url({{asset('template/bootcamp/asset/4.jpg')}});">
                  <div style="bottom: 8%;position:absolute;color:#fff;">
                    <b>Rizki Alif Irfany</b>
                    <br>
                    <i>Google Expert</i>
                  </div>
                </div>   
              </div>
            </div>
          </div>
        </div>

        <div class="row question">
          <div class="col-xs-12 text-center mb-5">
            <h2 class="title">Apakah bootcamp ini cocok dengan saya?</h2>
          </div>

          <div class="col-xs-6">    
            <b>Untuk siapa bootcamp ini ?:</b>
            <p class="text-muted">
              Seseorang yang ingin membuat data driven decisions atau tertarik
              menjadi Data Analys, program ini sangat ideal untuk anda. Anda akan
              belajar statistik, data wranglisng with Python, dan data visualization
            </p>
    
            <b>Apa Prasyarat dan Persyaratan mengikuti bootcamp ini :</b>
            <p class="text-muted">
              Agar berhasil dalam prgram ini, disarankan memiliki pengalaman :
              Python programming, termasuk data analytis libraries (e.g., Numpy
              anda Pandas), SQl Programming
            </p>
          </div>
          
          <div class="col-xs-6">    
            <b>Kenapa saya harus membeli ?</b>
            <ul>
              <li>
                Tutorial di Cilsy dibaut secara real dari hasil praktik tim internal,
                Semua sudah diuji coba sebelum dijual.
              </li>
              <li>
                Video dibuat denga kualitas tinggi ( lighting, suara, da tampilan
                gambar ) dan melalui proses editing.
              </li>
              <li>
                  Kursus ini onlinem Anda bsia menonton videonya kapanpun dan 
                  dimanapun Anda mau. Sangat fleksibel.
              </li>
              <li>Tersedia fasilitas support lifetime terkait isi materi tutorial dan</li>
            </ul>
          </div>
        </div>

        <div class="row fasilitas">
          <div class="col-xs-12 text-center">
            <h2 class="title">Fasilitas apa yang saya dapatkan ?</h2>
          </div>
          <div class="col-sm-6 col-xs-12">

            <div class="item">
              <div class="icon">
                <img src="{{asset('template/bootcamp/asset/FasilitasVideo.svg')}}" class="img-responsive" alt="">
              </div>
              <h5>Video</h5>
              Ada 32 video tutorial berkualitas tinggi yang direkam oleh tim
              tutorial creator Cilsy, bisa Anda tonton sendiri online, maupun di download.
            </div>

            <div class="item">
              <div class="icon">
                <img src="{{asset('template/bootcamp/asset/FasilitasDownload.svg')}}" class="img-responsive" alt="">
              </div>
              <h5>Offline Mode</h5>
              Seluruh video materu kursus dan eBook bebas anda download
              sehingga bisa Anda pelajari kapanpun dan dimanapun
            </div>

            <div class="item">
              <div class="icon">
                <img src="{{asset('template/bootcamp/asset/FasilitasScript.svg')}}" class="img-responsive" alt="">
              </div>
              <h5>Script</h5>
              Dalam beberapa sesi praktik yang membutuhkan script
              konfigurasi, kami sudah menyiapkan script tersebut. Anda hanya
              tinggal copy-paste saja.
            </div>

            <div class="item">
              <div class="icon">
                <img src="{{asset('template/bootcamp/asset/FasilitasSertifikat.svg')}}" class="img-responsive" alt="">
              </div>
              <h5>Sertifikat</h5>
              Jika Anda sudah menyelesaikan seluruh tutorial & praktek, Anda
              bisa membuat resume dan berhak mendapatkan sertifikat dari PT
              Cilsy.
            </div>


          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="item">
                <div class="icon">
                  <img src="{{asset('template/bootcamp/asset/FasilitasEbook.svg')}}" class="img-responsive" alt="">
                </div>
                <h5>Ebook</h5>
                bagi Anda yang tidak suka belajar melalui video, kami juga
                menyediakan eBook dengan isi yang sama untuk menunjang pembelajaran Anda.
              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="{{asset('template/bootcamp/asset/FasilitasAksesSelamanya.svg')}}" class="img-responsive" alt="">
                </div>
                <h5>Akses Selamanya</h5>
                Semua akses materi kursus tidak ada batasan waktunya. Semua
                dapat Anda memiliki selamanya. Hanya untuk Anda.
              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="{{asset('template/bootcamp/asset/FasilitasDiskusi.svg')}}" class="img-responsive" alt="">
                </div>
                <h5>Diskusi</h5>
                Kesulitan saat praktek ? Ada fitur diskusi di halaman tutorial di
                web. Tim support Cilsy akan membantu semua kendala Anda saat
                praktek.
              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="{{asset('template/bootcamp/asset/FasilitasUpdate.svg')}}" class="img-responsive" alt="">
                </div>
                <h5>Free Update</h5>
                Total video yang Anda dapatkan adalah 32 video. Jika ada
                pembaharuan materi baru, makan Anda bisa mendapatkannya
                GRATIS
              </div>

          </div>

        </div>

        <div class="row harga">
          <div class="col-xs-12 text-center">
            <h2 class="title">Mulai belajar sekarang</h2>
            
            <div class="border-blue">
              <div class="border-content">
                <h5 class="c-black">Bootcamp {{$bca->title}}</h5>
                <h1>Rp. {{$bca->price}}</h1>
                <ul>
                  <li>Ebook</li>
                  <li>Script konfig</li>
                  <li>Video Tutorial</li>
                  <li>Team support</li>
                  <li>FREE download</li>
                  <li>Unlimited Time</li>
                  <li>Free Update</li>
                  <li>Sertifikat</li>
                </ul>
                <button class="btn btn-blue">Daftar Sekarang</button>
                </div>  
            </div>
          </div>
        </div>

        <div class="row faq">
          <div class="col-xs-12">
              <h2 class="title text-center">Frequently Asked Questions</h2>

              <div class="panel-group" id="accordion" style="max-width: 800px;margin: 0 auto">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                      Kapan Materi Bisa Diakses?</a>
                    </h6>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body"> Anda memprakteka semua materi kursus online yang ada di dalam video tutorial kapanpun &
                        dimanapun. Anda juga bisa berdiskusi dengan tim support Cilsy menggunakan fasilitas
                        diskusi di web.</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                      Apa Bisa Dipejari Pemula?</a>
                    </h6>
                  </div>
                  <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                          Tutorialnya Berbentuk Apa?</a>
                    </h6>
                  </div>
                  <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                      Bagaimana Cara Belajarnya?</a>
                    </h6>
                  </div>
                  <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                      Kenapa saya harys membelu tutorial ini?</a>
                    </h6>
                  </div>
                  <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</div>
                  </div>
                </div>
              </div>
                
          </div>
        </div>

      </div>

      <!-- Modal -->
              <!-- Modal -->
<div class="modal fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <a class="btn close-icon" data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>
        <div class="modal-body p-0">
          <video width="100%" height="350" controls name="preview" controlsList="nodownload" ><source src="{{ asset($bca->promote_video)}}"></video>
        </div>
      </div>
    </div>
</div>

     <!--  <div class="m-5"></div> -->
    <link rel="stylesheet" href="{{asset('template/bootcamp/css/timeline-vertical.css')}}">
          
    <!-- JavaScript -->
    <script type="text/javascript" src="{{asset('template/bootcamp/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/bootcamp/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/bootcamp/js/slick.min.js')}}"></script>
    <script>
    $('.slick').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      adaptiveHeight: true,
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
          breakpoint: 600,
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
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    $('#collapse1').click(function(){ 
      $(this).text(function(i,old){
          return old=='+ Tampilkan Lebih Sedikit' ?  '- Tampilkan Lebih Banyak' : '+ Tampilkan Lebih Sedikit';
      });
    });
     $(function(){
      $('#ModalVideo').modal({
          show: false
      }).on('hidden.bs.modal', function(){
          $(this).find('video')[0].pause();
      });
    });
    $(document).ready(function(){
      $(".showModal").click(function(e){
        e.preventDefault();
        var url = $(this).attr("data-href");
        $("#ModalVideo video").attr("src", url);
        $("#ModalVideo").modal("show");
      });
     });
    </script>
    </script>
@endsection