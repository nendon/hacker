<?php $__env->startSection('title','Silabus'); ?>
<?php $__env->startSection('content'); ?>
  <body>
    
    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header" style="background-image: url(<?php echo e(asset('img/bg-head.jpg')); ?>);">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h6 class="mb-5">Dashboard/Track</h6>
              <h2 class="mb-4">Training to Become a <?php echo e($bc->slug); ?></h2>
              <h6>Are you a <?php echo e($bc->slug); ?>, or do you want to become one? In order to be successful in your role you will need to develop a few essentials soft
                skills in addition to your technical skills. In this path you will learn crucial technology management skill, how to effectively lead technology teams,
                and how to best manage technology projects. This content is not meant to be watched in order, so you can pickl your own adventure.
              </h6>
              <br>
              <button class="btn btn-second btn-lg mb-5">Mulai belajar</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Content -->
      <section class="container-fluid tabs-sylabus">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item active">
            <a class="nav-link" id="pills-kurikulum-tab" data-toggle="pill" href="#pills-kurikulum" role="tab" aria-controls="pills-kurikulum" aria-selected="true">Kurikulum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">Course Overview</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">File Praktek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-diskusi-tab" data-toggle="pill" href="#pills-diskusi" role="tab" aria-controls="pills-diskusi" aria-selected="false">Diskusi</a>
          </li>
        </ul>
      </section>

      <section class="mt-5">
        <div class="container">

          <div class="tab-content" id="pills-tabContent">

            <!-- Tab Kurikulum -->
            <div class="tab-pane fade active in" id="pills-kurikulum" role="tabpanel" aria-labelledby="pills-kurikulum-tab">
              <ul class="timelines">
                <?php
                     $i = 1;
                     foreach ($cs as $key => $courses): ?>
                      <?php if ($i <= 2) {?>
                  <li>           
                      <div class="timelines-number"><?php echo $i; ?></div>
                      <div class="timelines-content">
                        <div class="row row-eq-height box p-0">
                          
                          <?php if (!empty($courses->cover_course)) {?>
                          <div class="col-sm-4 col-xs-12 p-0" style="background: url(<?php echo e(asset($courses->cover_course)); ?>);background-size:cover;min-height: 250px"></div>
                            <!-- for image content use style background for full size of column -->
                          <?php } else {?>
                          <div class="col-sm-4 col-xs-12 p-0" style="background: url(<?php echo e(asset('template/web/img/no-image-available.png')); ?>);background-size:cover;min-height: 250px"></div>
                          <?php }?> 
                          
                          <div class="col-sm-8 col-xs-12">

                            <div class="row mt-3">
                              <div class="col-xs-6">
                                <h5>Course Part <?php echo $i; ?></h5> 
                              </div>
                              <div class="col-xs-5 mt-4">
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                              </div>
                              <div class="col-xs-1 p-0 pt-2">
                                0%
                              </div>
                            </div>
                              
                            <br>

                            <h4><?php echo e($courses->title); ?></h4>
                            <h6>
                              <?php echo e($courses->deskripsi); ?>

                            </h6>

                            <br>
                            
                            <small class="text-muted"><?php echo e($course->estimasi); ?> Jam </small> &nbsp;&nbsp;&nbsp; <small class="text-muted">Deadline 2 Hari</small>
                                
                            <br><br>

                            <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/courseLesson/'.$courses->id)); ?>" class="btn btn-primary mb-4">Mulai Belajar</a>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                          <?php $i++;?>
                          <?php endforeach; ?>
                  </li>
                  </ul>
            </div>
  
            <!-- Tab Course Overview -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
            </div>

            <!-- Tab File Praktek -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
            </div>

            <!-- Tab Diskusi -->
            <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
              <div class="row box">
                <div class="col-xs-12">
                  <h6>Buat Pertanyaan</h6>
                  <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="10">Apakah saya bisa mengupload projek melalui Link Google drive.</textarea>
                  <br>
                  <button class="btn btn-primary">Upload Gambar</button>
                  <button class="btn btn-primary">Tambah Pertanyaan</button>
                </div>

                <hr class="mt-5">

                <div class="col-xs-12">
                  <hr>
                  <span class="text-muted">Saat ini belum ada diskusi</span>
                </div>

                <hr class="mt-5">

                <div class="col-xs-12">
                  <hr>
                  <img src="<?php echo e(asset('img/users.png')); ?>" class="img-author mr-1 float-left" alt="">
                  <div class="float-left">
                   <b>Anda</b> <small class="text-muted">Pengguna - Berapa Detik yang lalu</small>
                    <h6 class="text-muted">Apakah saya bisa mengupload projek melalui Link Google drive.</h6>
                    <h6 class="text-muted">Apakah saya bisa mengupload projek melalui Link Google drive.</h6>
                    <h6 class="text-muted">Apakah saya bisa mengupload projek melalui Link Google drive.</h6>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </section>

    </main>

    <!-- JavaScript -->
    <script>
    $('#collapse').click(function(){ 
        $(this).text(function(i,old){
            return old=='+ Tampilkan Lebih Banyak' ?  '- Tampilkan Lebih Sedikit' : '+ Tampilkan Lebih Banyak';
        });
    });
    $('#pills-kurikulum-tab').on('click', function(e){
      $('.header').css("background-image", "url(img/bg-head.jpg)")
    });
    $('#pills-diskusi-tab').on('click', function(e){
      var img = $('.header').css("background-image", "url(img/bg-head2.jpg)");
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>