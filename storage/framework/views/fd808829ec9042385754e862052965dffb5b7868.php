<?php $__env->startPush('css'); ?>


<?php $__env->stopPush(); ?>

<!-- BEGIN TUTORIAL -->
<section class="tutorial mb-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

          <!-- New Bootcamp -->
          <div class="tutorial-row">
            <div class="row">
  
              <div class="col-md-9">
                <div class="title-area pb-25 hidden">
                  <div class="inner ">
                    <h2 class="mb-25">Kelas Bootcamp</h2>
                    <p>Update materi tutorial baru setiap bulan</p>
                  </div>                  
                </div>
                <a href="<?php echo e(url('browse/bootcamp/')); ?>" class="btn btn-default btn-more" style="color:teal; margin-top: -140px;">Browse Semua Bootcamp </a>
              </div>
              <div class="col-md-3">
                  <div class="bootcamp ">
                      <?php $__currentLoopData = $bootcamp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div>
                        <div class="card">
                          <div class="label">
                            Bootcamp
                          </div>
                          <?php if (!empty($result->cover)) {?>
                            <img src="<?php echo e(asset($result->cover)); ?>" alt="" class="img-responsive img-card" style="background-size:cover;">
                          <?php } else {?>
                            <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                          <?php }?>
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
          </div>
          <!-- /.New Tutorial -->

        
        <!-- New Tutorial -->
        <div class="tutorial-row">
          <div class="row">

            <div class="col-md-3">
              <div class="title-area pb-25 hidden">
                <div class="inner ">
                  <h2 class="mb-25">Materi Terbaru</h2>
                  <p>Update materi tutorial baru setiap bulan</p>
                </div>
              </div>
            </div>
            <?php
              $i = 1;
              foreach ($newlessons as $key => $lesson): ?>
                  <?php if ($i <= 3) {?>
                    <div class="col-md-3">
                      <?php if(!empty($lesson->nilai)){ ?>
                        <a href="<?php echo e(url('kelas/v3/'.$lesson->slug)); ?>">
                        <?php }else{?>
                          <a href="<?php echo e(url('lessons/'.$lesson->slug)); ?>">
                            <?php } ?>
                        <div class="card">
                          <?php if (!empty($lesson->image)) {?>
                            <img src="<?php echo e(asset($lesson->image)); ?>" alt="" class="img-responsive img-card">
                          <?php } else {?>
                            <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                          <?php }?>
                          <div class="harga">Rp. <?php echo e(number_format($lesson->price, 0, ",", ".")); ?></div>
                          <div class="caption" style="height:108px">
                            <p> <?php $sentence=  $lesson->title;
                            $numberofcharacters=105 ;
                            $print = substr($sentence, 0, $numberofcharacters);
                            echo $print;if(strlen($sentence) >105){?>...<?php } ?></p>
                            
                          </div>
                          <div class="footer">
                            <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                          </div>
                        </div>
                        
                         
                      </a>
                    </div>
                <?php } ?>
                <?php $i++;?>
            <?php endforeach; ?>

          </div>
          <div class="row">
            <div class="col-md-12">
              <a href="<?php echo e(url('lessons/browse/all')); ?>" class="btn btn-default btn-more pull-right">Selengkapnya <img src="<?php echo e(asset('template/web/img/selengkapnya.png')); ?>" alt="" height="10px" width="10px"/></a>
            </div>
          </div>
        </div>
        <!-- /.New Tutorial -->

        <!-- List Tutorial -->
        <?php
        $c = 1;
        foreach ($categories as $key => $category): ?>
        <?php if($c % 2 == 0 ){?>
          <!-- Genap -->
          <div class="tutorial-row">
            <div class="row">
              <div class="col-md-3">
                <div class="title-area pb-25 hidden">
                  <div class="inner">
                    <h2 class="mb-25"><?php echo e($category->title); ?></h2>
                    <?= $category->description;?>
                  </div>
                </div>
              </div>
              <?php
                $i = 1;
                foreach ($lessons as $key => $lesson): ?>
                  <?php if ($category->id == $lesson->category_id) {?>
                    <?php if ($i <= 3) {?>
                      <div class="col-md-3">
                        <?php if(!empty($lesson->nilai)){ ?>
                        <a href="<?php echo e(url('kelas/v3/'.$lesson->slug)); ?>">
                        <?php }else{?>
                          <a href="<?php echo e(url('lessons/'.$lesson->slug)); ?>">
                            <?php } ?>
                          <div class="card">
                            <?php if (!empty($lesson->image)) {?>
                              <img src="<?php echo e(asset($lesson->image)); ?>" alt="" class="img-responsive img-card">
                            <?php } else {?>
                              <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                            <?php }?>
                            <div class="harga">Rp.<?php echo e(number_format($lesson->price, 0, ",", ".")); ?></div>
                            <div class="caption" style="height:108px">
                            <p> <?php $sentence=  $lesson->title;
                            $numberofcharacters=105;
                            $print = substr($sentence, 0, $numberofcharacters);
                            echo $print; if(strlen($sentence) >105){?>...<?php } ?></p>
                              
                            </div>
                            <div class="footer">
                              <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                            </div>
                          </div>
                        </a>
                      </div>
                  <?php } ?>
                  <?php $i++;?>
                <?php } ?>

              <?php endforeach; ?>

            </div>
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo e(url('lessons/category/'.$category->title)); ?>" class="btn btn-default btn-more pull-right">Selengkapnya <i class="ion-arrow-right-c"></i></a>
              </div>
            </div>
          </div>
          <?php $c++; ?>
        <?php }else{ ?>
          <!-- Ganjil -->
          <div class="tutorial-row">
            <div class="row">

              <?php
                $i = 1;
                foreach ($lessons as $key => $lesson): ?>
                  <?php if ($category->id == $lesson->category_id) {?>
                    <?php if ($i <= 3) {?>
                      <div class="col-md-3">
                          <?php if(!empty($lesson->nilai)){ ?>
                            <a href="<?php echo e(url('kelas/v3/'.$lesson->slug)); ?>">
                            <?php }else{?>
                              <a href="<?php echo e(url('lessons/'.$lesson->slug)); ?>">
                                <?php } ?>
                          <div class="card">
                            <?php if (!empty($lesson->image)) {?>
                              <img src="<?php echo e(asset($lesson->image)); ?>" alt="" class="img-responsive img-card">
                            <?php } else {?>
                              <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                            <?php }?>
                            <div class="harga">Rp. <?php echo e(number_format($lesson->price, 0, ",", ".")); ?></div>
                            <div class="caption" style="height:108px">
                            <p> <?php $sentence=  $lesson->title;
                            $numberofcharacters=105;
                            $print = substr($sentence, 0, $numberofcharacters);
                            echo $print;if(strlen($sentence) >105){?>...<?php } ?></p>
                            </div>
                            <div class="footer">
                              <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                            </div>
                          </div>
                        </a>
                      </div>
                  <?php } ?>
                  <?php $i++;?>
                <?php } ?>

              <?php endforeach; ?>

              <div class="col-md-3 text-right">
                <div class="title-area pb-25 hidden ">
                  <div class="inner">
                    <h2 class="mb-25"><?php echo e($category->title); ?></h2>
                    <?= $category->description;?>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo e(url('lessons/category/'.$category->title)); ?>" class="btn btn-default btn-more pull-left">Selengkapnya <i class="ion-arrow-right-c"></i></a>
              </div>
            </div>
          </div>
          <?php $c++; ?>
        <?php } ?>

        <?php endforeach; ?>
        <!-- /.List Tutorial -->


        <!-- Button Tutorial -->
        <div class="row">
          <div class=" col-md-6">
            <a href="<?php echo e(url('lessons/browse/all')); ?>" class="">
              <div class="card button">
                <div class="row">
                  <div class="col-xs-12 col-md-4 text-center">
                    <i class="ion-android-apps"></i>
                  </div>
                  <div class="col-xs-12 col-md-8">
                    <h2>Lihat Semua Kategori</h2>
                    <p class="description">Pilih kategori sesuai minat Anda</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo e(url('lessons/browse/all')); ?>" class="">
              <div class="card button">
                <div class="row">
                  <div class="col-xs-12 col-md-4 text-center">
                    <i class="ion-play"></i>
                  </div>
                  <div class="col-xs-12 col-md-8">
                    <h2>Lihat Semua Tutorial</h2>
                    <p class="description">Tampilkan lebih banyak tutorial</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <!--/. Button Tutorial -->




      </div>
    </div>
  </div>
</section><!-- ./END TUTORIAL -->

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
  $(document).on('ready',function () {

    var wh = $(window).width();
    if (wh >768) {
      var h = $('.tutorial .tutorial-row').height() - 50;
      $('.tutorial .tutorial-row .title-area').height(h);

    }

    $('.tutorial .tutorial-row .title-area').removeClass('hidden');

  });
</script>

<script>
    var settingslick = {
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
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

    $('.bootcamp').slick(settingslick);
</script>


<?php $__env->stopPush(); ?>
