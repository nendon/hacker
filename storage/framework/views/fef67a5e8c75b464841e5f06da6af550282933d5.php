<?php $__env->startSection('title',$bca->title); ?>
<?php $__env->startSection('description', $bca->description); ?>
<?php $__env->startSection('content'); ?>
  
<style>
  .owl-theme .owl-dots .owl-dot span {
    width: 45px;
    height: 10px;
    margin: 5px 7px;
    background: #D6D6D6;
    display: block;
    -webkit-backface-visibility: visible;
    transition: opacity .2s ease;
    border-radius: 30px;
}
</style>
      
      <!-- Container -->
      <div class="container w-100">

        <!-- Header -->
        <div class="row headers">
          <div class="col-xs-12">
            <ul class="breadcrumb">
              <li><a href="<?php echo e(url('browse/bootcamp')); ?>" style="color: white">Browse</a></li>
              <li><a href="<?php echo e(url('browse/bootcamp/'.$butcat->slug)); ?>" style="color: white"><?php echo e($butcat->title); ?></a></li>
              <li class="active"><a href="<?php echo e(url('bootcamp/'.$bca->slug)); ?>" style="color: white"><?php echo e($bca->title); ?></a></li>
            </ul>
          </div>
          <div class="col-md-5 col-xs-12 mb-4 video-previews">
          <a href="<?php echo e($bca->promote_video); ?>" data-toggle="modal" data-target="#ModalVideo">
            <img src="<?php echo e(asset($bca->cover)); ?>" class="img-responsive img-rounded" alt="">
            <a href="<?php echo e($bca->promote_video); ?>" data-toggle="modal" data-target="#ModalVideo" class="btn"><img src="<?php echo e(asset('/template/web/img/play-button.svg')); ?>" class="img-play-size" alt="">
           </a>
          </a>
          </div>
          <div class="col-md-7 col-xs-12 mb-4">
           <a href="<?php echo e(url('browse/bootcamp/'.$butcat->slug)); ?>" style="color: white"><span>Bootcamp <?php echo e($butcat->title); ?></span></a>

            <h2><?php echo e($bca->title); ?></h2>
            <h4>
              <?php echo e($bca->sub_title); ?>

            </h4> 
            <h6 class="mb-5">oleh <?php echo e($contributors->username); ?></h6>
            <?php if(!$tutor): ?>
            <?php if(($cart != null)){ ?>
            <a href="<?php echo e(url('cart')); ?>" class="btn btn-blue" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
            <?php }else{ ?>          
            <button id="beli-<?php echo e($bca->id); ?>" class="btn btn-blue" onclick="addToCartBootcamp(<?php echo e($bca->id); ?>)"><i class="fa fa-shopping-cart"></i> Daftar Sekarang</button> &nbsp;&nbsp;&nbsp;
            <?php } ?>
            <a id="guest-<?php echo e($bca->id); ?>" class="btn btn-blue" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" href="<?php echo e(url('cart')); ?>" >Lihat Keranjang</a>
            <?php else: ?>
            <a href="<?php echo e(url('bootcamp/'.$bca->slug.'/courseSylabus')); ?>" class="btn btn-blue" style="background-color:Orange;color:white;border-color:#46b8da; " >Mulai Belajar</a> &nbsp;&nbsp;&nbsp;       
            <?php endif; ?>
            <a href="<?php echo e($bca->silabus); ?>" class="btn btn-blue m-2">Download Silabus</a>
          </div>
        </div>

        <!-- Tahukan Anda -->
        
        <div class="row section1">
          <div class="container">
            <div class="col-md-5 col-sm-8 col-xs-12 px-0">
              <img src="<?php echo e(asset($bca->picture_problem)); ?>" class="img-responsive" alt="">
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12 px-5">
              <h3>Tahukah Anda?</h3>
              <p>
              <?php echo e($bca->problem); ?>

              </p>

            </div>
          </div>
      </div>

      <div class="row section2">
        <div class="container">
          <div class="col-md-5 col-sm-8 col-xs-12 px-0 col-md-push-7 pull-md-right">
            <img src="<?php echo e(asset($bca->picture_desk)); ?>" class="img-responsive" alt="">
          </div>

          <div class="col-md-7 col-sm-12 col-xs-12 px-5 col-md-pull-5">
            <h3>Tentang Bootcamp <?php echo e($bca->title); ?></h3>

            <ul id="about">
                <li class="panel">
                    <a  style="color:#2ba8e2" href="#about1" data-toggle="collapse" data-parent="#about" class="collapsed">
                      Deskripsi
                    </a>
                    <p id="about1" class="collapse in">
                      <?php echo e($bca->deskripsi); ?>

                    </p>
                </li>
                <li class="panel">
                    <a  style="color:#2ba8e2" href="#about2" data-toggle="collapse" data-parent="#about">
                      Kenapa harus belajar <?php echo e($bca->title); ?>?
                    </a>
                    <p id="about2" class="collapse">
                       <?php echo e($bca->alasan); ?>

                    </p>
                </li>
            </ul>
            </div>
          </div>

        </div>

      <div class="row section3">
        <div class="container">
          <div class="col-md-5 col-sm-8 col-xs-12 px-0">
            <img src="<?php echo e(asset($bca->picture_alasan)); ?>" class="img-responsive" alt="">
          </div>
          <div class="col-md-7 col-sm-12 col-xs-12 px-5">
            <h3 class="mb-5">Bagaimana Bootcamp membantu anda</h3>
            <h4>Daftar dan Pelajari</h4>
            <p>
            Bootcamp Cilsy adalah program terbaru dari Cilsy yang jauh lebih lengkap dibanding Tutorial biasa untuk membantu anda menguasai keterampilan Industri IT. 
            Cari bootcamp yang ideal dengan kebutuhan skill dan juga tujuan karir anda dimasa depan. 
            Kurikulum di bootcamp diatur agar lebih tersusun dan jelas kurikulumnya, 
            serta disesuaikan dengan kebutuhan industri, Materi dibuat oleh Instruktur superstar (praktisi ahli) yang menguasai bidangnya masing-masing.
            </p>

            <br>
            <h4>Kerjakan Real Projek, Dapatkan Review</h4>
            <p>
            Di setiap materi anda harus menyelesaikan real projek maupun exersise untuk menunjukan anda benar-benar menguasai materi. 
            Projek dan exercise yang dikerjakan, akan berguna untuk membuat portofolio saat memulai karir Anda di bidang IT.
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
              <h3>Apa yang akan Anda Pelajari di Bootcamp ini</h3>

              <p class="text-muted">Kami membantu Anda menjadi seorang Tech Talent berkualitas dalam Bootcamp <?php echo e($bca->title); ?> dengan bantuan kurikulum yang terstruktur.</p>
              <ul>
                <li><img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Estimasi.svg')); ?>" alt="">Estimasi <?php echo e($target->target); ?> Hari</li>
                <li><img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Projek.svg')); ?>" alt=""> <?php echo e($project_bootcamp->durasi); ?> Projek</li>
                <li><img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Projek.svg')); ?>" alt=""> <?php echo e($pg_bootcamp->durasi); ?> Exercise</li>
                <li><img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Course.svg')); ?>" alt=""><?php echo e($bca->course->count()); ?>  Course</li>
                <li><img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Waktu.svg')); ?>" alt=""> <?php echo gmdate("H", $durasi_bootcamp->durasi)." Jam ".gmdate("i", $durasi_bootcamp->durasi)." Menit ".gmdate("s", $durasi_bootcamp->durasi)." Detik"; ?></li>
              </ul>
              <a href="<?php echo e($bca->silabus); ?>" class="btn btn-blue">Download Silabus</a>

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
                    <div class="col-sm-4 col-xs-12 p-0 images img-responsive" style="background: url(<?php echo e(asset($courses->cover_course)); ?>); background-size:cover;">
                      <!-- for image content use style background for full size of column -->
                    </div>
                    <div class="col-sm-8 col-xs-12">
                      <h4><?php echo e($courses->title); ?></h4>
                      <p>   
                       <?php echo e($courses->deskripsi); ?>

                      </p>

                      <hr>
                      <img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Course.svg')); ?>" alt=""><?php echo e(count($courses->section)); ?> Lesson      
                      <a class="pull-right" data-toggle="collapse" href="#section<?php echo e($courses->id); ?>">+ Lebih banyak</a>
                    </div>
                    <div class="col-xs-12">
                        <div class="collapse" id="section<?php echo e($courses->id); ?>">
                          <ul class="lesson-detail">
                          <?php
                          $no = 1;
                              foreach ($courses->section as $key => $sections): ?>
                              <li>
                                <div class="lesson-number">Lesson <h3 class="m-0"><?php echo $no; ?></h3></div>
                                <div class="lesson-content">
                                  <h4><?php echo e($sections->title); ?></h4>
                                    <p class="mb-5">
                                      <?php echo e($sections->deskripsi); ?>

                                    </p>
                                    <img src="<?php echo e(asset('template/bootcamp/asset/Lesson.svg')); ?>" alt=""> <?php echo e(count($sections->video_section)); ?> Video (
                                      <?php 
                                        $totalmenit = DB::table('video_section')
                                        ->where('section_id', $sections->id)
                                        ->select(DB::raw('sum(durasi) as total'))
                                        ->first();
                                        echo gmdate("H",$totalmenit->total)." Jam ".gmdate("i",$totalmenit->total)." Menit ".gmdate("s",$totalmenit->total)." Detik ";
                                      ?>
                                      ), 
                                      <?php 
                                        $cek = DB::table('exercise')
                                        ->where('section_id', $sections->id)
                                        ->first();
                                        if($cek){        
                                          ?>
                                          <?php echo e(count($sections->exercise)); ?> Exercise
                                        <?php }else{ ?>
                                          <?php echo e(count($sections->project_section)); ?> Projek
                                      <?php } ?>
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
                    if($count>2 && $no>2 ){ ?>
                  <li>
                    <div class="timelinez-number">
                      <h4>Course</h4>
                      <h1><?php echo $a; ?></h1>
                    </div>
                    <div class="timelinez-content">
                      <div class="row box p-0">
                        <div class="col-sm-4 col-xs-12 p-0 images" style="background: url(<?php echo e(asset($courses->cover_course)); ?>);">
                          <!-- for image content use style background for full size of column -->
                        </div>
                        <div class="col-sm-8 col-xs-12">
                          <h4><?php echo e($courses->title); ?></h4>
                          <p>
                            <?php echo e($courses->deskripsi); ?>

                          </p>
                          
                          <hr>
                          <img src="<?php echo e(asset('template/bootcamp/asset/smallicon-Course.svg')); ?>" alt=""><?php echo e(count($courses->section)); ?> Lesson   
                          <a class="pull-right" data-toggle="collapse" href="#silabus<?php echo e($courses->id); ?>">+ Lebih banyak</a>
                        </div>

                        <div class="col-xs-12">
                        <div class="collapse" id="silabus<?php echo e($courses->id); ?>">
                          <ul class="lesson-detail">
                          <?php
                          $no = 1;
                              foreach ($courses->section as $key => $sections): ?>
                              <li>
                                <div class="lesson-number">Lesson <h3 class="m-0"><?php echo $no; ?></h3></div>
                                <div class="lesson-content">
                                <h4><?php echo e($sections->title); ?></h4>
                                <p class="mb-5">
                                  <?php echo e($sections->deskripsi); ?>

                                </p>
                                <img src="<?php echo e(asset('template/bootcamp/asset/Lesson.svg')); ?>" alt=""><?php echo e(count($sections->video_section)); ?> Video (
                                  <?php 
                                    $totalmenit = DB::table('video_section')
                                    ->where('section_id', $sections->id)
                                    ->select(DB::raw('sum(durasi) as total'))
                                    ->first();
                                    echo gmdate("H",$totalmenit->total)." Jam ".gmdate("i",$totalmenit->total)." Menit ".gmdate("s",$totalmenit->total)." Detik ";
                                  ?>
                                  ), 
                                  <?php 
                                  $cek = DB::table('exercise')
                                  ->where('section_id', $sections->id)
                                  ->first();
                                  if($cek){        
                                    ?>
                                    <?php echo e(count($sections->exercise)); ?> Exercise
                                  <?php }else{ ?>
                                    <?php echo e(count($sections->project_section)); ?> Projek
                                <?php } ?>
                                  
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
              <img src="<?php echo e(asset($bca->contributor->avatar)); ?>" class="img-responsive img-circle mx-auto" alt="">
              <h4 class="c-blue"><?php echo e($bca->contributor->first_name); ?> <?php echo e($bca->contributor->last_name); ?></h4>
              <h5><?php echo e($bca->contributor->pekerjaan); ?></h5>
              <p class="text-muted">
                  <?php echo e($bca->contributor->deskripsi); ?>

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
                <div class="box" style="height: 350px;">
            
                  <p>
                    "Alhamdulillaah...saya mendapat banyak ilmu disini. Mudah2an saya bisa lebih percaya diri mengajar karena banyak kosakata baru di dunia IT."
                  </p>
                  
                  <div class="name">
                    <img src="<?php echo e(url('/assets/source/images/testimoni/fitrih.png')); ?>" class="w-25 pull-left mr-4" alt="">
                    Fitri Handayani <br>
                    Guru SMK
                  </div>
                </div>
              </div>

              <div>
                <div class="box" style="height: 350px;">
                  <p>
                    "Materi sangat bagus dan bisa didownload. Jadi bisa belajar kapanpun dirumah. Saya pun bisa minta dipandu step by stepnya oleh trainernya. Jadi ngga takut gagal" 
                  </p>
                  
                  <div class="name">
                    <img src="<?php echo e(url('/assets/source/images/testimoni/ludy.png')); ?>" class="w-25 pull-left mr-4" alt="">
                    Ludy<br>
                    Sysadmin
                  </div>
                </div>
              </div>

              
                <!-- <div class="box image" style="background-image: url(<?php echo e(asset('template/bootcamp/asset/4.jpg')); ?>);">
                  <div style="bottom: 8%;position:absolute;color:#fff;">
                    <b>Rizki Alif Irfany</b>
                    <br>
                    <i>Google Expert</i>
                  </div>
                </div>    -->
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                      "Pengajar bersertifikasi dan berpengalaman, nanya-nanya sama trainernya pun malem juga tetep dijawab. mantap. Saya belajar banyak ilmu baru disini yang berguna menunjang pekerjaan saya." 
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/muhf.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Eka Saeful<br>
                      Trainer Mikrotik
                    </div>
                  </div>
                </div>
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                    "Dengan Harga yang terjangkau saya merasa puas dengan semua materi yang diberikan. <br>Pilihan materi pun banyak dan bagus-bagus. Cocok untuk pemula hingga advanced. Orang jaringan sangat recommended kursus online disini."
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/ekas.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Muh Fitrah<br>
                      Network Admin
                    </div>
                  </div>
                </div>
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                    "Alhamdulillah cukup puas dengan materi yang disampaikan.<br>Singkat, padat dan jelas. <br>Lebih paham, sekalipun peserta awam."
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/safarulm.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Safarul M<br>
                      IT Support
                    </div>
                  </div>
                </div>
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                    "Sangat interaktif, penjelasan juga analogi pemahamannya mudah dipahami<br>sehingga materi yang disampaikan dapat langsung diaplikasikan"
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/sentota.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Sentot Andi<br>
                      Staff IT
                    </div>
                  </div>
                </div>
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                    "Updatean materinya ditunggu mas. hehehe <br>Ngga sabar buat belajar materi-materi baru terus di cilsy."
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/aguss.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Agus Supriyono<br>
                      Technical Support
                    </div>
                  </div>
                </div>
                <div>
                  <div class="box" style="height: 350px;">
                    <p>
                    "Penyampaian materi sangat mudah dipahami, harga kursus online sangat terjangkau. Sukses Selalu Buat Cilsy Foulation"
                    </p>
                    
                    <div class="name">
                      <img src="<?php echo e(url('/assets/source/images/testimoni/michaels.png')); ?>" class="w-25 pull-left mr-4" alt="">
                      Michael Situmorang<br>
                      Network Admin
                    </div>
                  </div>
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
              <?php echo e($bca->audience); ?>

            </p>
    
            <b>Apa Prasyarat dan Persyaratan mengikuti bootcamp ini :</b>
            <p class="text-muted">
             <?php echo e($bca->pre_and_req); ?>

            </p>
          </div>
          
          <div class="col-xs-6">    
            <b>Kenapa saya harus membeli ?</b>
            <ul>
              <li>
              Bootcamp di Cilsy ini merupakan pembelajaran full online dengan video on-demand, 
              bukan berupa pembelajaran live streaming dengan jadwal tertentu. 
              Sehingga Anda bisa belajar kapanpun dimanapun sesuai ritme belajar Anda sendiri.
              </li>
              <li>
              Anda bebas bertanya dengan instruktur jika mengalami kesulitan. 
              Dan instruktur dijamin akan memberikan jawaban dan bantuan.
              </li>
              <li>
              Sepanjang Bootcamp Anda akan diajak mengerjakan berbagai exercise dan real projek sehingga benar-benar dapat memahami isi materinya.
              </li>
              <li>Karena materi Bootcamp ini benar-benar didesain untuk kebutuhan Industri, maka setelah lulus Bootcamp Anda akan diberikan fasilitas untuk disalurkan magang dan kerja</li>
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
                <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasVideo.svg')); ?>" class="img-responsive" alt="">
              </div>
              <h5>Video</h5>
              Materi berupa video berkualitas yang bisa Anda tonton sendiri online, maupun di download.
            </div>

            <div class="item">
              <div class="icon">
                <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasDownload.svg')); ?>" class="img-responsive" alt="">
              </div>
              <h5>Offline Mode</h5>
              Seluruh materi Bootcamp bebas anda download sehingga bisa Anda pelajari kapanpun dan dimanapun
            </div>

            <div class="item">
              <div class="icon">
                <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasScript.svg')); ?>" class="img-responsive" alt="">
              </div>
              <h5>Script</h5>
              Dalam beberapa sesi praktik yang membutuhkan script
              konfigurasi, kami sudah menyiapkan script tersebut. Anda hanya
              tinggal copy-paste saja.
            </div>

            <div class="item">
              <div class="icon">
                <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasSertifikat.svg')); ?>" class="img-responsive" alt="">
              </div>
              <h5>Sertifikat</h5>
              Jika Anda sudah menyelesaikan seluruh materi, exersice, dan projek, Anda bisa membuat resume dan berhak mendapatkan sertifikat dari Cilsy.
            </div>


          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="item">
                <div class="icon">
                  <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasEbook.svg')); ?>" class="img-responsive" alt="">
                </div>
                <h5>Kesempatan Berkarir</h5>
                Setelah lulus Anda akan diberikan fasilitas untuk dibantu disalurkan magang dan kerja ke perusahaan-perusahaan yang sudah bekerjasama dengan Cilsy

              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasAksesSelamanya.svg')); ?>" class="img-responsive" alt="">
                </div>
                <h5>Akses Selamanya</h5>
                Semua akses materi Bootcamp tidak ada batasan waktunya. Semua dapat Anda memiliki selamanya. Hanya untuk Anda.
              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasDiskusi.svg')); ?>" class="img-responsive" alt="">
                </div>
                <h5>Diskusi</h5>
                Kesulitan saat praktek ? Ada fitur diskusi yang dapat Anda gunakan untuk berdiskusi dengan Instruktur untuk memecahkan kendala yang Anda alami
              </div>
  
              <div class="item">
                <div class="icon">
                  <img src="<?php echo e(asset('template/bootcamp/asset/FasilitasUpdate.svg')); ?>" class="img-responsive" alt="">
                </div>
                <h5>Free Update</h5>
                Jika ada pembaharuan materi baru, maka Anda bisa mendapatkannya secara GRATIS tanpa perlu membayar kembali.
              </div>

          </div>

        </div>

        <div class="row harga">
          <div class="col-xs-12 text-center">
            <h2 class="title">Mulai belajar sekarang</h2>
            
            <div class="border-blue">
              <div class="border-content">
                <h5 class="c-black">Bootcamp <?php echo e($bca->title); ?></h5>
                <h1>Rp. <?php echo e(number_format($bca->price, 0, ",", ".")); ?></h1>
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
                <?php if(!$tutor): ?>
                <?php if(($cart != null)){ ?>
                <a href="<?php echo e(url('cart')); ?>" class="btn btn-blue" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
                <?php }else{ ?>          
                <button id="jual-<?php echo e($bca->id); ?>" class="btn btn-blue" onclick="addToCartBootcamp(<?php echo e($bca->id); ?>)"><i class="fa fa-shopping-cart"></i> Daftar Sekarang</button> &nbsp;&nbsp;&nbsp;
                <?php } ?>
                <a id="tamu-<?php echo e($bca->id); ?>" class="btn btn-blue" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" href="<?php echo e(url('cart')); ?>" >Lihat Keranjang</a>
                <?php else: ?>
                <a href="<?php echo e(url('bootcamp/'.$bca->slug.'/courseSylabus')); ?>" class="btn btn-blue" style="background-color:Orange;color:white;border-color:#46b8da; " >Mulai Belajar</a> &nbsp;&nbsp;&nbsp;         
                <?php endif; ?>
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
                    <div class="panel-body"> Materi langsung bisa diakses setelah Anda membeli.</div>
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
                    <div class="panel-body">Sangat bisa. Seluruh materi telah disusun dari awal sampai akhir sehingga sangat mudah untuk diikuti oleh pemula.</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                      Materinya berbentuk apa?</a>
                    </h6>
                  </div>
                  <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">Berbentuk video, exercise, dan projek</div>
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
                    <div class="panel-body">Anda tinggal menonton materi-materi video yang sudah disediakan sesuai urutan kurikulum. 
                    Disepanjang materi dari awal sampai akhir bootcamp Anda harus menyelesaikan exercise dan Projek yang diberikan</div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h6 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                      Apakah materi bisa di download?</a>
                    </h6>
                  </div>
                  <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">Bisa. Nanti anda tinggal lakukan download materinya. 
                    Namun Anda tetap harus menyelesaikan exercise dan projek yang diberikan untuk bisa mengakses materi-materi berikutnya.</div>
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
          <video width="100%" height="350" controls name="preview" controlsList="nodownload" ><source src="<?php echo e(asset($bca->promote_video)); ?>"></video>
        </div>
      </div>
    </div>
</div>

     <!--  <div class="m-5"></div> -->
    <link rel="stylesheet" href="<?php echo e(asset('template/bootcamp/css/timeline-vertical.css')); ?>">
          
    <!-- JavaScript -->
    <script type="text/javascript" src="<?php echo e(asset('template/bootcamp/js/jquery-3.3.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('template/bootcamp/js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('template/bootcamp/js/slick.min.js')); ?>"></script>
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

<script>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
              $('#beli-'+v['id']).hide();
              $('#guest-'+v['id']).show();
              $('#jual-'+v['id']).hide();
              $('#tamu-'+v['id']).show();
        });
      }
    }
    <?php if($cart != null): ?>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
          $('#guest-'+v['id']).hide();
          $('#tamu-'+v['id']).hide();
        });
      }
    }
    
    <?php endif; ?>

  </script>
  <script type="text/javascript" src="<?php echo e(asset('template/web/js/owl.carousel.min.js')); ?>"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin: 5,
    // nav:true,
    responsive:{
        0:{
            items:1,
            dots:false
        },
        600:{
            items:3,
            dots:false
        },
        1000:{
            items:3
        }
    }
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>