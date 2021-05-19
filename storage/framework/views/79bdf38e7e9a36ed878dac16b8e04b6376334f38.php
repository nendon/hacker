<?php $__env->startSection('title','Browse Bootcamp'); ?>

<style>
        
</style>
<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $boot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url('browse/bootcamp/'.$boots->slug)); ?>" style="text-decoration:none;">
                <div>
                  <div class="kotak" style="background:url(<?php echo e(asset($boots->cover)); ?>); background-size:cover;">
                    <h4 style="font-weight: bold';"><?php echo e($boots->title); ?></h4>
                  </div>
                </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php $__currentLoopData = $boot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row kategori-list">
            <div class="col-xs-12">
              <h2><?php echo e($key->title); ?></h2>
              <a href="<?php echo e(url('browse/bootcamp/'.$key->slug)); ?>" class="btn btn-blue pull-right mt-4">Selengkapnya</a>

              <p>
                    <?php echo nl2br($key->meta_desc); ?>

              </p>

              <div class="programming">
                <?php $__currentLoopData = $key->bootcamp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                  <div class="card">
                    <div class="label">
                      Bootcamp
                    </div>
                    <img src="<?php echo e(asset($result->cover)); ?>" class="card-img-top img-responsive" alt="..." style="background-size:cover;">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="<?php echo e(asset($result->contributor->avatar)); ?>" class="img-author" alt="">
                        <small class="text-muted"><?php echo e($result->contributor->username); ?></small>
                      </div>
                      <h5>
                        <?php echo e($result->title); ?>

                      </h5>
                      <p>
                        <?php echo $result->deskripsi; ?>

                      </p>
                      <ul>
                        <li>
                          <i class="fa fa-book"></i> <?php echo e(count($result->course)); ?> Course
                        </li>
                        <li>
                          <i class="fa fa-user"></i> <?php echo e(count($result->bootcamp_member)); ?> Siswa
                        </li>
                        <li>
                          <a href="#"> Selengkapnya</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
          <div class="row video sm-flex">
            <div class="col-sm-5 col-xs-12 p-0">
              <!-- <img src="asset/1.jpg" class="img-responsive" alt=""> -->
              <iframe width="560" height="315" src="https://www.youtube.com/embed/QjT4PiFswO4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </video>
            </div>
            <div class="col-sm-7 col-xs-12 content">
              <h2>Apa itu Program Bootcamp?</h2>
              <p>
                Program Mentoring online untuk mendidik Anda menjadi seorang Professional dalam 16 minggu dengan
                jaminan pernyaluran kerja. Kurikulum dirancang agar Anda yang tidak memiliki background IT tetap
                bisa memulai karir di dunia IT.
              </p>
            </div>
          </div>

          <div class="row features">
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="<?php echo e(asset('img/asset/CompleteCurriculum.svg')); ?>" alt="">
              <h4>Complete Curriculum</h4>
              <p class="px-5">
                Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
              </p>
            </div>
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="<?php echo e(asset('img/asset/RealProjectGetReview.svg')); ?>" alt="">
              <h4>Real Project, Get Review</h4>
              <p class="px-5">
                Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
              </p>
            </div>
            <div class="col-sm-4 col-xs-12 text-center mb-5">
              <img src="<?php echo e(asset('img/asset/ReadytoGetHired.svg')); ?>" alt="">
              <h4>Ready to Get Hired</h4>
              <p class="px-5">
                Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
              </p>
            </div>
          </div>
          
        </div>
      
        <div class="m-5">x</div>
      </div>

    </main>
    <script type="text/javascript" src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>