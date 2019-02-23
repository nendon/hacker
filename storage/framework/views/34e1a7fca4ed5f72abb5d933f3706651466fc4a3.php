<?php $__env->startSection('title','Browse Bootcamp'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/halaman.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>">
<style>
        
</style>
<?php $__env->startSection('content'); ?>
    <main>
      
      <!-- Container -->
      <div class="container-fluid">

        <!-- Header -->
        <div class="row header">
          <div class="col-xs-12">
            <h1><?php echo e($bucat->title); ?></h1>
            <p>
              <?php echo nl2br($bucat->meta_desc); ?>

            </p>
              
            <div class="kategori-small">
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url('browse/bootcamp/'.$keys->slug)); ?>" style="text-decoration:none;">
              <div>
                <h5><?php echo e($keys->title); ?></h5>
              </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>



        <div class="container mt-4">
          <div class="row">

            <div class="col-xs-12 mt-5">
              <h3 class="my-5">Bootcamp Programming Terbaru</h3>
              
              <div class="slick2 mt-5">
                <?php $__currentLoopData = $new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                  <div class="row box sm-flex p-0 mx-0">
                    <div class="col-sm-4 col-xs-12 p-0 preview" style="background: url(<?php echo e(asset($news->cover)); ?>); background-size:cover;">
                      <div class="label">
                        Bootcamp
                      </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                      <ul class="breadcrumb">
                        <li><a href="<?php echo e(url('browse/bootcamp/'.$news->bootcamp_category->slug)); ?>"><?php echo e($news->bootcamp_category->title); ?></a></li>
                        <li class="active"><?php echo e($news->title); ?></li>
                      </ul>

                      <div class="author">
                        <img src="<?php echo e($news->contributor->avatar); ?>" class="img-author" alt="">
                        <?php echo e($news->contributor->first_name); ?> <?php echo e($news->contributor->last_name); ?>

                      </div>

                      <h4><?php echo e($news->title); ?></h4>
                      <p>
                        <?php echo e($news->deskripsi); ?>

                      </p>

                      <div class="my-4">
                          <ul class="icon">
                            <li>
                              <i class="fa fa-book-open"></i> <?php echo e(count($news->course)); ?> Course
                            </li>
                            <li>
                              <i class="fa fa-users"></i> <?php echo e(count($news->bootcamp_member)); ?> Siswa
                            </li>
                          </ul>
                        <div class="pull-right">
                          <a href="<?php echo e(url('bootcamp/'.$news->slug)); ?>" class="btn btn-blue mb-4">Selengkapnya</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

          </div>

            <div class="row card-eq-height">
              <div class="col-xs-12">
                <h3>Semua Bootcamp <?php echo e($bucat->title); ?></h3>
              </div>
            
              <!-- Box Content -->
              <?php $__currentLoopData = $hasil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $has): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-4">
                <a href="<?php echo e(url('bootcamp/'.$has->slug)); ?>" style="text-decoration:none; color:black;">
                <div class="card">
                  <div class="label">
                    Bootcamp
                  </div>
                  <img src="<?php echo e(asset($has->cover)); ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <div class="card-author">
                      <img src="<?php echo e(asset($has->contributor->avatar)); ?>" class="img-author" alt="">
                      <small class="text-muted"><?php echo e($has->contributor->first_name); ?> <?php echo e($has->contributor->last_name); ?></small>
                    </div>
                    <h5>
                      <?php echo e($has->title); ?>

                    </h5>
                    <p>
                      <?php echo e($has->deskripsi); ?>

                    </p>
                    <ul>
                      <li>
                        <i class="fa fa-book"></i> <?php echo e(count($has->course)); ?> Course
                      </li>
                      <li>
                        <i class="fa fa-user"></i> <?php echo e(count($has->bootcamp_member)); ?> Siswa
                      </li>
                      <li>
                        <a href="#"> Selengkapnya</a>
                      </li>
                    </ul>
                  </div>
                </div>
                </a>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <!-- End Box Conten -->
            </div>

            <div class="row mt-5">
              <div class="col-xs-12 text-center">
                <nav aria-label="Page navigation">
                  <ul class="pagination m-0">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                      </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>

        </div>
      
        <div class="m-5">x</div>
      </div>

    </main>
    <script type="text/javascript" src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>