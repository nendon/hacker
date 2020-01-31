<?php $__env->startSection('title','Dashboard Belajar Saya'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main -->
    <main>
      <link rel="stylesheet" href="<?php echo e(asset('css/timeline.min.css')); ?>">
      <!-- Section Header -->
      <section class="header">
      </section>

      <section>

        <!-- Container -->
        <?php if($last): ?>
        <div class="container">

          <!-- Row -->
          <div class="row box p-0">
          
          <?php if($last->cover): ?>
            <div class="col-sm-4 col-xs-12 p-0 image-preview" style="background: url(<?php echo e(asset($last->cover)); ?>);">
              <!-- Image for full width  & height -->
            </div>
          <?php else: ?>
            <div class="col-sm-4 col-xs-12 p-0 image-preview" style="background: url(<?php echo e(asset('img/head.png')); ?>);">
              <!-- Image for full width  & height -->
            </div>
          <?php endif; ?>
            <div class="col-sm-8 col-xs-12">
              <h4><?php echo e($last->title); ?></h4>
              <h6><?php echo e($last->course_title); ?></h6>
              <!-- Timeline -->
              <div class="timeline">
                  <div class="timeline__wrap">
                    <div class="timeline__items">
                    <?php $no=1; ?>
                    <?php $__currentLoopData = $last_course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $last_course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($last_course->hasil == $last_course->target): ?>
                      <div class="timeline__item active">
                      <?php else: ?>
                      <div class="timeline__item ">
                      <?php endif; ?>
                        <div class="timeline__content">
                          <h5 class="lesson-title">Lesson  <?php echo $no; $no++;?></h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
               <!-- Timeline -->

               <?php if(!$last): ?>
               <a href="<?php echo e(url('bootcamp/'.$last->slug.'/courseSylabus')); ?>" class="btn btn-primary btn-lg mt-5 mb-2">Lanjutkan</a>
               <?php else: ?>
              <a href="<?php echo e(url('bootcamp/'.$last->slug.'/courseLesson/'.$last->id_course)); ?>" class="btn btn-primary btn-lg mt-5 mb-2">Lanjutkan</a>
              <?php endif; ?>
         
            </div>
          </div>
          <?php endif; ?>

          <!-- Tabs-->
          <div class="tabs-dashboard">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link pills-filter" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="true">Tutorial</a>
              </li>
              <li class="nav-item">
                <a class="nav-link pills-filter" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">Bootcamp</a>
              </li>
            </ul>
          </div>

          <div class="tab-content" id="pills-tabContent">

            <!-- Tab Tutorial -->
            <div class="tab-pane fade active in" id="pills-tutorial" role="tabpanel" aria-labelledby="pills-tutorial-tab">
              <div class="row">
                <div class="col-sm-8 col-xs-12">
                  <h4 class="c-blue mt-4">Semua Tutorial yang diikuti dan Terselesaikan</h4>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="filter">
                    <ul class="filter-nav">
                      <li class="filter-item active" data-id="tutorial" data-filter="*">
                        <span class="filter-link" href="#">Semua</span>
                      </li>
                      <li class="filter-item" data-id="tutorial" data-filter=".diikuti">
                        <span class="filter-link" href="#">Diikuti</span>
                      </li>
                      <li class="filter-item" data-id="tutorial" data-filter=".selesai">
                        <span class="filter-link" href="#">Selesai</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
                 
              <div class="row grid" >
               <!-- start Tutorial yang all -->
              
               
             
              <!-- start Tutorial yang diikuti -->  
              
                <!-- Box Content -->
               
                <?php $__currentLoopData = $belitut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lessons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                <?php if($lessons->hasil != $lessons->target): ?>
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <?php if($lessons->image): ?>
                        <img
                            src="<?php echo e(asset($lessons->image)); ?>"
                            alt=""
                            class="img-responsive"
                        >
                    <?php else: ?>
                        <img
                            src="<?php echo e(asset('img/card-1.png')); ?>"
                            alt=""
                            class="img-responsive">
                    <?php endif; ?>
                    <div class="card-body">
                      <div class="card-author">
                      <?php if($lessons->avatar): ?>
                        <img src="<?php echo e(asset($lessons->avatar)); ?>" class="img-author" alt="">
                      <?php else: ?>
                        <img src="<?php echo e(asset('img/users.png')); ?>" class="img-author" alt="">
                      <?php endif; ?>
                        <?php echo e($lessons->username); ?>

                      </div>
                      <h5 class="card-title">
                        <?php echo e($lessons->title); ?>

                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                        <?php $proses = number_format($lessons->hasil*100/$lessons->target); ?>
                          <div class="progress-bar" role="progressbar" style="width: <?php echo $proses;?>%" aria-valuenow="<?php echo $proses;?>" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            <?php echo $proses;?>%
                          </div>
                        </div>
                      </div>
                      <a href="<?php echo e(url('kelas/v3/'.$lessons->slug)); ?>" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                <?php endif; ?>
                </div> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
              <!-- end Tutorial yang diikuti -->  

               <!-- start Tutorial yang full -->  
               <?php if($full): ?>
               <?php $__currentLoopData = $full; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $full): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all selesai">
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <?php if($full->image): ?>
                        <img
                            src="<?php echo e(asset($full->image)); ?>"
                            alt=""
                            class="img-responsive"
                        >
                    <?php else: ?>
                        <img
                            src="<?php echo e(asset('img/card-1.png')); ?>"
                            alt=""
                            class="img-responsive">
                    <?php endif; ?>
                    <div class="card-body">
                      <div class="card-author">
                      <?php if($full->avatar): ?>
                        <img src="<?php echo e(asset($full->avatar)); ?>" class="img-author" alt="">
                      <?php else: ?>
                        <img src="<?php echo e(asset('img/users.png')); ?>" class="img-author" alt="">
                      <?php endif; ?>
                        <?php echo e($full->username); ?>

                      </div>
                      <h5 class="card-title">
                        <?php echo e($full->title); ?>

                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            100%
                          </div>
                        </div>
                      </div>
                      <a href="<?php echo e(url('kelas/v3/'.$full->slug)); ?>" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                </div> 
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
               <?php endif; ?>
              <!-- end Tutorial yang full --> 
              </div>

   
            </div>
            <!-- End Tab Tutorial -->

            <!-- Tab Learning Path -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-xs-12">
                    <h4 class="c-blue mt-4">Semua Bootcamp yang diikuti dan Terselesaikan</h4>
                  </div>
                  <div class="col-sm-4 col-xs-12">
                    <div class="filter">
                      <ul class="filter-nav">
                      <li class="filter-item active" data-id="learning" data-filter="*">
                        <span class="filter-link" href="#">Semua</span>
                      </li>
                      <li class="filter-item" data-id="learning" data-filter=".diikuti">
                        <span class="filter-link" href="#">Diikuti</span>
                      </li>
                      <li class="filter-item" data-id="learning" data-filter=".selesai">
                        <span class="filter-link" href="#">Selesai</span>
                      </li>
                      </ul>
                    </div>
                  </div>
                </div>
                      
              <div class="row grid">
              <!-- Bootcamp diikuti-->
              <?php $__currentLoopData = $bootcamp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bootcamp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                <?php if($bootcamp->hasil != $bootcamp->target): ?>
                  <div class="card">
                    <div class="label">
                      Bootcamp
                    </div>
                    <?php if($bootcamp->cover): ?>
                        <img
                            src="<?php echo e(asset($bootcamp->cover)); ?>"
                            alt=""
                            class="img-responsive"
                        >
                    <?php else: ?>
                        <img
                            src="<?php echo e(asset('img/card-1.png')); ?>"
                            alt=""
                            class="img-responsive">
                    <?php endif; ?>
                    <div class="card-body">
                      <div class="card-author">
                      <?php if($bootcamp->avatar): ?>
                        <img src="<?php echo e(asset($bootcamp->avatar)); ?>" class="img-author" alt="">
                      <?php else: ?>
                        <img src="<?php echo e(asset('img/users.png')); ?>" class="img-author" alt="">
                      <?php endif; ?>
                        <?php echo e($bootcamp->username); ?>

                      </div>
                      <h5 class="card-title">
                        <?php echo e($bootcamp->title); ?>

                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                        <?php $progress = number_format($bootcamp->hasil*100/$bootcamp->target); ?>
                          <div class="progress-bar" role="progressbar" style="width: <?php echo $progress;?>%" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            <?php echo $progress;?>%
                          </div>
                        </div>
                      </div>
                      <a href="<?php echo e(url('bootcamp/'.$bootcamp->slug.'/courseSylabus')); ?>" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                <?php endif; ?>   
                </div> 
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <!-- end Bootcamp diikuti -->

              <!-- Bootcamp diikuti-->
              <?php $__currentLoopData = $full_boot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $full_boot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-3 col-sm-6 col-xs-12 p-4 all selesai">
                <?php if($full_boot->hasil == $full_boot->target): ?>
                <div class="card">
                  <div class="label">
                    Bootcamp
                  </div>
                  <?php if($full_boot->cover): ?>
                      <img
                          src="<?php echo e(asset($full_boot->cover)); ?>"
                          alt=""
                          class="img-responsive"
                      >
                  <?php else: ?>
                      <img
                          src="<?php echo e(asset('img/card-1.png')); ?>"
                          alt=""
                          class="img-responsive">
                  <?php endif; ?>
                  <div class="card-body">
                    <div class="card-author">
                    <?php if($full_boot->avatar): ?>
                      <img src="<?php echo e(asset($full_boot->avatar)); ?>" class="img-author" alt="">
                    <?php else: ?>
                      <img src="<?php echo e(asset('img/users.png')); ?>" class="img-author" alt="">
                    <?php endif; ?>
                      <?php echo e($full_boot->username); ?>

                    </div>
                    <h5 class="card-title">
                      <?php echo e($full_boot->title); ?>

                    </h5>
                    <div class="card-progress">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-number">
                          100%
                        </div>
                      </div>
                    </div>
                    <a href="<?php echo e(url('bootcamp/'.$full_boot->slug.'/courseSylabus')); ?>" class="btn btn-outline-primary">Lanjutkan</a>
                  </div>
                </div>
                <?php endif; ?>
              </div> 
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <!-- end Bootcamp diikuti -->
              </div>
                
              </div>  
            </div>

          </div>


        </div>
      </section>

    </main>

    


    <!-- JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script> -->
    <!-- <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> -->
    <script type="text/javascript" src="<?php echo e(asset('js/isotope.pkgd.min.js')); ?>"></script>
    <script>
    /* Timeline */
		$(function(){
			$('.timeline').timeline({
				mode: 'horizontal',
				forceVerticalMode: 100
			});
		});

    //------- Filter  js --------//  
    $('.filter-nav li').click(function(){
      $('.filter-nav li').removeClass('active');
      $(this).addClass('active');

      var id = $(this).attr('data-id');
      var data = $(this).attr('data-filter');
      if(id="learning"){
        $gridlearning.isotope({
          filter: data
        })
      }
      if(id="tutorial"){
        $gridtutorial.isotope({
          filter: data
        })
      }
     
    });

    if($("#pills-tutorial.tab-pane")||$("#pills-learning.tab-pane")){
        var $gridtutorial = $("#pills-tutorial .grid").isotope({
          itemSelector: ".all",
          layoutMode: 'masonry',
          percentPosition: true,
          masonry: {
            columnWidth: ".all"
          }
        })
        var $gridlearning = $("#pills-learning .grid").isotope({
          itemSelector: ".all",
          layoutMode: 'masonry',
          percentPosition: true,
          masonry: {
            columnWidth: ".all"
          }
        })
    };


    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
      var tabIsotope =  $(this).attr("aria-controls");
      if(tabIsotope=='pills-tutorial'){
        $gridtutorial.isotope('layout');
        }else{
        $gridlearning.isotope('layout');
      }
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>